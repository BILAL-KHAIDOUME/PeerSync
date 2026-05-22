<?php

namespace App\Models;

use App\Core\Database;

/**
 * TutoringSession Model
 * Handles session operations
 */
class TutoringSession {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Create new session
     */
    public function create(array $data): ?int {
        $sql = "INSERT INTO tutoring_sessions 
                (request_id, student_id, tutor_id, start_time, status) 
                VALUES (:request_id, :student_id, :tutor_id, :start_time, :status)";
        
        $params = [
            ':request_id' => $data['request_id'],
            ':student_id' => $data['student_id'],
            ':tutor_id' => $data['tutor_id'],
            ':start_time' => $data['start_time'],
            ':status' => 'scheduled'
        ];

        if ($this->db->execute($sql, $params)) {
            return (int)$this->db->lastInsertId();
        }
        return null;
    }

    /**
     * Find session by ID
     */
    public function findById(int $id): ?array {
        $sql = "SELECT * FROM tutoring_sessions WHERE id = :id LIMIT 1";
        return $this->db->fetchOne($sql, [':id' => $id]);
    }

    /**
     * Get active sessions for user
     */
    public function getActiveSessions(int $userId): array {
        $sql = "SELECT ts.*, u1.nom as student_nom, u1.prenom as student_prenom,
                       u2.nom as tutor_nom, u2.prenom as tutor_prenom
                FROM tutoring_sessions ts
                LEFT JOIN users u1 ON ts.student_id = u1.id
                LEFT JOIN users u2 ON ts.tutor_id = u2.id
                WHERE (ts.student_id = :user_id OR ts.tutor_id = :user_id)
                AND ts.status IN ('scheduled', 'in_progress')
                ORDER BY ts.start_time DESC";
        return $this->db->fetchAll($sql, [':user_id' => $userId]);
    }

    /**
     * Get completed sessions for user
     */
    public function getCompletedSessions(int $userId, int $limit = 10): array {
        $sql = "SELECT ts.*, u1.nom as student_nom, u1.prenom as student_prenom,
                       u2.nom as tutor_nom, u2.prenom as tutor_prenom,
                       (SELECT AVG(rating) FROM ratings WHERE session_id = ts.id) as avg_rating
                FROM tutoring_sessions ts
                LEFT JOIN users u1 ON ts.student_id = u1.id
                LEFT JOIN users u2 ON ts.tutor_id = u2.id
                WHERE (ts.student_id = :user_id OR ts.tutor_id = :user_id)
                AND ts.status = 'completed'
                ORDER BY ts.end_time DESC
                LIMIT :limit";
        return $this->db->fetchAll($sql, [':user_id' => $userId, ':limit' => $limit]);
    }

    /**
     * Start session
     */
    public function startSession(int $sessionId): bool {
        $sql = "UPDATE tutoring_sessions SET status = 'in_progress' WHERE id = :id";
        return $this->db->execute($sql, [':id' => $sessionId]);
    }

    /**
     * End session
     */
    public function endSession(int $sessionId, ?string $notes = null): bool {
        $sql = "UPDATE tutoring_sessions 
                SET status = 'completed', 
                    end_time = CURRENT_TIMESTAMP,
                    duration_minutes = TIMESTAMPDIFF(MINUTE, start_time, CURRENT_TIMESTAMP),
                    notes = :notes
                WHERE id = :id";
        return $this->db->execute($sql, [':id' => $sessionId, ':notes' => $notes]);
    }

    /**
     * Cancel session
     */
    public function cancelSession(int $sessionId): bool {
        $sql = "UPDATE tutoring_sessions SET status = 'cancelled' WHERE id = :id";
        return $this->db->execute($sql, [':id' => $sessionId]);
    }

    /**
     * Get stats for user
     */
    public function getUserStats(int $userId): array {
        $completed = $this->db->fetchOne(
            "SELECT COUNT(*) as total FROM tutoring_sessions WHERE (student_id = :user_id OR tutor_id = :user_id) AND status = 'completed'",
            [':user_id' => $userId]
        );

        $hours = $this->db->fetchOne(
            "SELECT COALESCE(SUM(duration_minutes), 0) as total FROM tutoring_sessions WHERE (student_id = :user_id OR tutor_id = :user_id) AND status = 'completed'",
            [':user_id' => $userId]
        );

        return [
            'total_sessions' => (int)($completed['total'] ?? 0),
            'total_hours' => intdiv((int)($hours['total'] ?? 0), 60),
            'total_minutes' => (int)($hours['total'] ?? 0)
        ];
    }

    /**
     * Get all sessions (admin)
     */
    public function getAllSessions(int $limit = 50, int $offset = 0): array {
        $sql = "SELECT ts.*, u1.nom as student_nom, u2.nom as tutor_nom
                FROM tutoring_sessions ts
                LEFT JOIN users u1 ON ts.student_id = u1.id
                LEFT JOIN users u2 ON ts.tutor_id = u2.id
                ORDER BY ts.start_time DESC
                LIMIT :limit OFFSET :offset";
        return $this->db->fetchAll($sql, [':limit' => $limit, ':offset' => $offset]);
    }

    /**
     * Delete session
     */
    public function delete(int $id): bool {
        $sql = "DELETE FROM tutoring_sessions WHERE id = :id";
        return $this->db->execute($sql, [':id' => $id]);
    }
}
