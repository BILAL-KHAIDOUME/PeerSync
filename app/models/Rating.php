<?php

namespace App\Models;

use App\Core\Database;

/**
 * Rating Model
 * Handles ratings and reviews
 */
class Rating {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Create new rating
     */
    public function create(array $data): ?int {
        if ($data['rating'] < 1 || $data['rating'] > 5) {
            return null;
        }

        $sql = "INSERT INTO ratings (session_id, reviewer_id, reviewee_id, rating, comment) 
                VALUES (:session_id, :reviewer_id, :reviewee_id, :rating, :comment)";
        
        $params = [
            ':session_id' => $data['session_id'],
            ':reviewer_id' => $data['reviewer_id'],
            ':reviewee_id' => $data['reviewee_id'],
            ':rating' => $data['rating'],
            ':comment' => $data['comment'] ?? null
        ];

        if ($this->db->execute($sql, $params)) {
            return (int)$this->db->lastInsertId();
        }
        return null;
    }

    /**
     * Get rating by session and reviewer
     */
    public function getBySessionAndReviewer(int $sessionId, int $reviewerId): ?array {
        $sql = "SELECT * FROM ratings WHERE session_id = :session_id AND reviewer_id = :reviewer_id LIMIT 1";
        return $this->db->fetchOne($sql, [':session_id' => $sessionId, ':reviewer_id' => $reviewerId]);
    }

    /**
     * Get all ratings for user
     */
    public function getUserRatings(int $userId, int $limit = 10): array {
        $sql = "SELECT r.*, u.nom, u.prenom, u.avatar, ts.subject
                FROM ratings r
                JOIN users u ON r.reviewer_id = u.id
                JOIN tutoring_sessions ts ON r.session_id = ts.id
                WHERE r.reviewee_id = :user_id
                ORDER BY r.created_at DESC
                LIMIT :limit";
        return $this->db->fetchAll($sql, [':user_id' => $userId, ':limit' => $limit]);
    }

    /**
     * Get user average rating
     */
    public function getUserAverageRating(int $userId): float {
        $sql = "SELECT AVG(rating) as avg_rating FROM ratings WHERE reviewee_id = :user_id";
        $result = $this->db->fetchOne($sql, [':user_id' => $userId]);
        return (float)($result['avg_rating'] ?? 0);
    }

    /**
     * Count user ratings
     */
    public function getUserRatingCount(int $userId): int {
        $sql = "SELECT COUNT(*) as count FROM ratings WHERE reviewee_id = :user_id";
        $result = $this->db->fetchOne($sql, [':user_id' => $userId]);
        return (int)($result['count'] ?? 0);
    }

    /**
     * Update rating
     */
    public function update(int $ratingId, array $data): bool {
        $updates = [];
        $params = [':id' => $ratingId];

        $allowedFields = ['rating', 'comment'];
        foreach ($allowedFields as $field) {
            if (isset($data[$field])) {
                $updates[] = "$field = :$field";
                $params[":$field"] = $data[$field];
            }
        }

        if (empty($updates)) {
            return false;
        }

        $updates[] = "updated_at = CURRENT_TIMESTAMP";
        $sql = "UPDATE ratings SET " . implode(", ", $updates) . " WHERE id = :id";
        
        return $this->db->execute($sql, $params);
    }

    /**
     * Delete rating
     */
    public function delete(int $id): bool {
        $sql = "DELETE FROM ratings WHERE id = :id";
        return $this->db->execute($sql, [':id' => $id]);
    }

    /**
     * Get rating distribution for user
     */
    public function getRatingDistribution(int $userId): array {
        $sql = "SELECT rating, COUNT(*) as count FROM ratings WHERE reviewee_id = :user_id GROUP BY rating";
        $results = $this->db->fetchAll($sql, [':user_id' => $userId]);
        
        $distribution = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        foreach ($results as $row) {
            $distribution[$row['rating']] = $row['count'];
        }
        
        return $distribution;
    }
}
