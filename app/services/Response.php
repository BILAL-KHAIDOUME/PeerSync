<?php

namespace App\Core;

/**
 * JSON Response Helper
 * Handles API responses
 */
class Response {
    
    /**
     * Send JSON response
     */
    public static function json(array $data, int $statusCode = 200): void {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    /**
     * Success response
     */
    public static function success(array $data = [], string $message = 'Success'): void {
        self::json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], 200);
    }

    /**
     * Error response
     */
    public static function error(string $message = 'Error', int $statusCode = 400, array $data = []): void {
        self::json([
            'success' => false,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    /**
     * Validation error
     */
    public static function validationError(array $errors): void {
        self::json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $errors
        ], 422);
    }

    /**
     * Not found
     */
    public static function notFound(string $message = 'Resource not found'): void {
        self::error($message, 404);
    }

    /**
     * Unauthorized
     */
    public static function unauthorized(string $message = 'Unauthorized'): void {
        self::error($message, 401);
    }

    /**
     * Forbidden
     */
    public static function forbidden(string $message = 'Access forbidden'): void {
        self::error($message, 403);
    }
}
