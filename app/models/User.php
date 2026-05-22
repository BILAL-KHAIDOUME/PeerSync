<?php

namespace App\Models;

use App\Core\Database;

/**
 * User Model
 * Handles all user-related database operations
 */
class User {
    private Database $db;

    public int $id;
    public string $nom;
    public string $prenom;
    public string $email;
    public string $password;
    public string $role;
    public int $points;
    public ?string $bio;
    public ?string $avatar;
    public bool $verified;
    public string $created_at;
    public string $updated_at;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Create new user
     */
    public function create(array $data): ?int {
        $sql = "INSERT INTO users (nom, prenom, email, password, role, bio, avatar, verified) 
                VALUES (:nom, :prenom, :email, :password, :role, :bio, :avatar, :verified)";
        
        $params = [
            ':nom' => $data['nom'],
            ':prenom' => $data['prenom'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_BCRYPT),
            ':role' => $data['role'] ?? 'student',
            ':bio' => $data['bio'] ?? null,
            ':avatar' => $data['avatar'] ?? null,
            ':verified' => $data['verified'] ?? false
        ];

        if ($this->db->execute($sql, $params)) {
            return (int)$this->db->lastInsertId();
        }
        return null;
    }

    /**
     * Check if email exists
     */
    public function emailExists(string $email): bool {
        $sql = "SELECT COUNT(*) as count FROM users WHERE email = :email LIMIT 1";
        $result = $this->db->fetchOne($sql, [':email' => $email]);
        return (int)($result['count'] ?? 0) > 0;
    }

    /**
     * Find user by email
     */
    public function findByEmail(string $email): ?array {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        return $this->db->fetchOne($sql, [':email' => $email]);
    }

    /**
     * Find user by ID
     */
    public function findById(int $id): ?array {
        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
        return $this->db->fetchOne($sql, [':id' => $id]);
    }

    /**
     * Verify password
     */
    public function verifyPassword(string $plainPassword, string $hashedPassword): bool {
        return password_verify($plainPassword, $hashedPassword);
    }

    /**
     * Update user profile
     */
    public function update(int $id, array $data): bool {
        $updates = [];
        $params = [':id' => $id];

        $allowedFields = ['nom', 'prenom', 'bio', 'avatar', 'verified'];
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
        $sql = "UPDATE users SET " . implode(", ", $updates) . " WHERE id = :id";
        
        return $this->db->execute($sql, $params);
    }

    /**
     * Add points to user
     */
    public function addPoints(int $userId, int $points): bool {
        $sql = "UPDATE users SET points = points + :points WHERE id = :id";
        return $this->db->execute($sql, [':points' => $points, ':id' => $userId]);
    }

    /**
     * Get all tutors (paginated)
     */
    public function getAllTutors(int $limit = 10, int $offset = 0): array {
        $sql = "SELECT * FROM users WHERE role = 'tutor' LIMIT :limit OFFSET :offset";
        return $this->db->fetchAll($sql, [':limit' => $limit, ':offset' => $offset]);
    }

    /**
     * Get tutor with skills
     */
    public function getTutorWithSkills(int $userId): ?array {
        $tutor = $this->findById($userId);
        if (!$tutor || $tutor['role'] !== 'tutor') {
            return null;
        }

        $sql = "SELECT * FROM user_skills WHERE user_id = :user_id";
        $tutor['skills'] = $this->db->fetchAll($sql, [':user_id' => $userId]);
        
        return $tutor;
    }

    /**
     * Get user rating average
     */
    public function getAverageRating(int $userId): float {
        $sql = "SELECT AVG(rating) as avg_rating FROM ratings WHERE reviewee_id = :user_id";
        $result = $this->db->fetchOne($sql, [':user_id' => $userId]);
        return (float)($result['avg_rating'] ?? 0);
    }

    /**
     * Get user total sessions
     */
    public function getTotalSessions(int $userId): int {
        $sql = "SELECT COUNT(*) as total FROM tutoring_sessions 
                WHERE (student_id = :user_id OR tutor_id = :user_id) AND status = 'completed'";
        $result = $this->db->fetchOne($sql, [':user_id' => $userId]);
        return (int)($result['total'] ?? 0);
    }

    /**
     * Get user total hours
     */
    public function getTotalHours(int $userId): int {
        $sql = "SELECT SUM(duration_minutes) as total FROM tutoring_sessions 
                WHERE (student_id = :user_id OR tutor_id = :user_id) AND status = 'completed'";
        $result = $this->db->fetchOne($sql, [':user_id' => $userId]);
        $minutes = (int)($result['total'] ?? 0);
        return intdiv($minutes, 60);
    }

    /**
     * Email exists?
     */
    public function emailExists(string $email): bool {
        return $this->findByEmail($email) !== null;
    }

    /**
     * Delete user
     */
    public function delete(int $id): bool {
        $sql = "DELETE FROM users WHERE id = :id";
        return $this->db->execute($sql, [':id' => $id]);
    }
}
