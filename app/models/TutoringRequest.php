<?php

namespace App\Models;

use App\Core\Database;

/**
 * TutoringRequest Model
 * Handles tutoring request operations
 */
class TutoringRequest {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Create new tutoring request
     */
    public function create(array $data): ?int {
        $sql = "INSERT INTO tutoring_requests 
                (student_id, subject, level, description, status, duration_hours, preferred_rate, preferred_date_time) 
                VALUES (:student_id, :subject, :level, :description, :status, :duration_hours, :preferred_rate, :preferred_date_time)";
        
        $params = [
            ':student_id' => $data['student_id'],
            ':subject' => $data['subject'],
            ':level' => $data['level'],
            ':description' => $data['description'],
            ':status' => 'pending',
            ':duration_hours' => $data['duration_hours'] ?? null,
            ':preferred_rate' => $data['preferred_rate'] ?? null,
            ':preferred_date_time' => $data['preferred_date_time'] ?? null
        ];

        if ($this->db->execute($sql, $params)) {
            return (int)$this->db->lastInsertId();
        }
        return null;
    }

    /**
     * Find request by ID
     */
    public function findById(int $id): ?array {
        $sql = "SELECT * FROM tutoring_requests WHERE id = :id LIMIT 1";
        return $this->db->fetchOne($sql, [':id' => $id]);
    }

    /**
     * Get all pending requests
     */
    public function getPendingRequests(int $limit = 10, int $offset = 0): array {
        $sql = "SELECT r.*, u.nom, u.prenom, u.email 
                FROM tutoring_requests r
                LEFT JOIN users u ON r.student_id = u.id
                WHERE r.status = 'pending'
                ORDER BY r.created_at DESC
                LIMIT :limit OFFSET :offset";
        return $this->db->fetchAll($sql, [':limit' => $limit, ':offset' => $offset]);
    }

    /**
     * Get student's requests
     */
    public function getStudentRequests(int $studentId, ?string $status = null): array {
        $sql = "SELECT * FROM tutoring_requests WHERE student_id = :student_id";
        $params = [':student_id' => $studentId];

        if ($status) {
            $sql .= " AND status = :status";
            $params[':status'] = $status;
        }

        $sql .= " ORDER BY created_at DESC";
        return $this->db->fetchAll($sql, $params);
    }

    /**
     * Get requests by subject
     */
    public function getRequestsBySubject(string $subject, int $limit = 10): array {
        $sql = "SELECT r.*, u.nom, u.prenom 
                FROM tutoring_requests r
                LEFT JOIN users u ON r.student_id = u.id
                WHERE r.subject = :subject AND r.status = 'pending'
                ORDER BY r.created_at DESC
                LIMIT :limit";
        return $this->db->fetchAll($sql, [':subject' => $subject, ':limit' => $limit]);
    }

    /**
     * Assign tutor to request
     */
    public function assignTutor(int $requestId, int $tutorId): bool {
        $sql = "UPDATE tutoring_requests 
                SET assigned_tutor_id = :tutor_id, status = 'assigned' 
                WHERE id = :id";
        return $this->db->execute($sql, [':tutor_id' => $tutorId, ':id' => $requestId]);
    }

    /**
     * Update request status
     */
    public function updateStatus(int $requestId, string $status): bool {
        $sql = "UPDATE tutoring_requests SET status = :status, updated_at = CURRENT_TIMESTAMP WHERE id = :id";
        return $this->db->execute($sql, [':status' => $status, ':id' => $requestId]);
    }

    /**
     * Cancel request
     */
    public function cancel(int $requestId): bool {
        return $this->updateStatus($requestId, 'cancelled');
    }

    /**
     * Get count of pending requests
     */
    public function countPending(): int {
        $sql = "SELECT COUNT(*) as count FROM tutoring_requests WHERE status = 'pending'";
        $result = $this->db->fetchOne($sql);
        return (int)($result['count'] ?? 0);
    }

    /**
     * Search requests with filters
     */
    public function search(array $filters): array {
        $sql = "SELECT r.*, u.nom, u.prenom FROM tutoring_requests r
                LEFT JOIN users u ON r.student_id = u.id
                WHERE r.status = 'pending'";
        $params = [];

        if (!empty($filters['subject'])) {
            $sql .= " AND r.subject = :subject";
            $params[':subject'] = $filters['subject'];
        }

        if (!empty($filters['level'])) {
            $sql .= " AND r.level = :level";
            $params[':level'] = $filters['level'];
        }

        if (!empty($filters['duration'])) {
            $sql .= " AND r.duration_hours <= :duration";
            $params[':duration'] = $filters['duration'];
        }

        $sql .= " ORDER BY r.created_at DESC LIMIT 50";
        return $this->db->fetchAll($sql, $params);
    }

    /**
     * Delete request
     */
    public function delete(int $id): bool {
        $sql = "DELETE FROM tutoring_requests WHERE id = :id";
        return $this->db->execute($sql, [':id' => $id]);
    }
}
