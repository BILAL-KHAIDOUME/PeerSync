<?php

namespace App\Services;

use App\Models\User;

/**
 * Authentication Service
 * Handles user authentication and session management
 */
class AuthService {
    private User $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    /**
     * Register new user
     */
    public function register(array $data): array {
        // Validate input
        if (empty($data['nom']) || empty($data['prenom']) || empty($data['email']) || empty($data['password'])) {
            return ['success' => false, 'message' => 'All fields are required'];
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Invalid email format'];
        }

        if (strlen($data['password']) < 6) {
            return ['success' => false, 'message' => 'Password must be at least 6 characters'];
        }

        if ($this->userModel->emailExists($data['email'])) {
            return ['success' => false, 'message' => 'Email already registered'];
        }

        // Create user
        $userId = $this->userModel->create($data);
        
        if ($userId) {
            return ['success' => true, 'message' => 'Registration successful', 'user_id' => $userId];
        }

        return ['success' => false, 'message' => 'Registration failed'];
    }

    /**
     * Login user
     */
    public function login(string $email, string $password): array {
        $user = $this->userModel->findByEmail($email);

        if (!$user) {
            return ['success' => false, 'message' => 'User not found'];
        }

        if (!$this->userModel->verifyPassword($password, $user['password'])) {
            return ['success' => false, 'message' => 'Invalid password'];
        }

        // Start session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_name'] = $user['prenom'] . ' ' . $user['nom'];

        return ['success' => true, 'message' => 'Login successful', 'user' => $user];
    }

    /**
     * Logout user
     */
    public function logout(): bool {
        session_destroy();
        return true;
    }

    /**
     * Check if user is logged in
     */
    public static function isLoggedIn(): bool {
        return isset($_SESSION['user_id']);
    }

    /**
     * Check if user is admin
     */
    public static function isAdmin(): bool {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }

    /**
     * Check if user is tutor
     */
    public static function isTutor(): bool {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'tutor';
    }

    /**
     * Check if user is student
     */
    public static function isStudent(): bool {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'student';
    }

    /**
     * Get current user ID
     */
    public static function getCurrentUserId(): ?int {
        return $_SESSION['user_id'] ?? null;
    }

    /**
     * Require login
     */
    public static function requireLogin(): void {
        if (!self::isLoggedIn()) {
            header('Location: /login.php');
            exit;
        }
    }

    /**
     * Require role
     */
    public static function requireRole(string $role): void {
        self::requireLogin();
        if ($_SESSION['user_role'] !== $role) {
            header('HTTP/1.0 403 Forbidden');
            exit('Access denied');
        }
    }
}
