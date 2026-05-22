<?php

namespace App\Utils;

/**
 * Validation Helper
 * Provides common validation methods
 */
class Validator {
    
    private array $errors = [];

    /**
     * Validate email
     */
    public function email(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Validate password strength
     */
    public function passwordStrength(string $password): bool {
        return strlen($password) >= 6 &&
               preg_match('/[A-Z]/', $password) &&
               preg_match('/[0-9]/', $password);
    }

    /**
     * Validate required fields
     */
    public function required(array $data, array $fields): bool {
        foreach ($fields as $field) {
            if (empty($data[$field])) {
                $this->errors[$field] = ucfirst($field) . ' is required';
            }
        }
        return empty($this->errors);
    }

    /**
     * Validate min length
     */
    public function minLength(string $value, int $min, string $fieldName): bool {
        if (strlen($value) < $min) {
            $this->errors[$fieldName] = "$fieldName must be at least $min characters";
            return false;
        }
        return true;
    }

    /**
     * Validate max length
     */
    public function maxLength(string $value, int $max, string $fieldName): bool {
        if (strlen($value) > $max) {
            $this->errors[$fieldName] = "$fieldName must not exceed $max characters";
            return false;
        }
        return true;
    }

    /**
     * Validate rating (1-5)
     */
    public function rating(int $rating): bool {
        return $rating >= 1 && $rating <= 5;
    }

    /**
     * Get errors
     */
    public function getErrors(): array {
        return $this->errors;
    }

    /**
     * Has errors
     */
    public function hasErrors(): bool {
        return !empty($this->errors);
    }

    /**
     * Clear errors
     */
    public function clearErrors(): void {
        $this->errors = [];
    }
}

/**
 * String Helper
 */
class StringHelper {
    
    /**
     * Sanitize string input
     */
    public static function sanitize(string $input): string {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Slugify string
     */
    public static function slug(string $string): string {
        $string = strtolower($string);
        $string = preg_replace('/[^a-z0-9]+/', '-', $string);
        return trim($string, '-');
    }

    /**
     * Truncate string
     */
    public static function truncate(string $string, int $length = 100, string $suffix = '...'): string {
        if (strlen($string) <= $length) {
            return $string;
        }
        return substr($string, 0, $length) . $suffix;
    }

    /**
     * Extract initials
     */
    public static function initials(string $firstName, string $lastName): string {
        return strtoupper($firstName[0] ?? '') . strtoupper($lastName[0] ?? '');
    }
}

/**
 * Date Helper
 */
class DateHelper {
    
    /**
     * Format date for display
     */
    public static function format(string $date, string $format = 'M d, Y'): string {
        return date($format, strtotime($date));
    }

    /**
     * Get time ago
     */
    public static function timeAgo(string $date): string {
        $time = strtotime($date);
        $now = time();
        $diff = $now - $time;

        if ($diff < 60) {
            return "$diff seconds ago";
        } elseif ($diff < 3600) {
            $mins = intdiv($diff, 60);
            return "$mins minute" . ($mins > 1 ? 's' : '') . " ago";
        } elseif ($diff < 86400) {
            $hours = intdiv($diff, 3600);
            return "$hours hour" . ($hours > 1 ? 's' : '') . " ago";
        } elseif ($diff < 604800) {
            $days = intdiv($diff, 86400);
            return "$days day" . ($days > 1 ? 's' : '') . " ago";
        } else {
            return self::format($date);
        }
    }

    /**
     * Calculate duration in hours
     */
    public static function durationHours(string $startTime, string $endTime): float {
        $start = strtotime($startTime);
        $end = strtotime($endTime);
        $diffSeconds = $end - $start;
        return round($diffSeconds / 3600, 2);
    }
}

/**
 * Math Helper
 */
class MathHelper {
    
    /**
     * Calculate average
     */
    public static function average(array $numbers): float {
        return count($numbers) > 0 ? array_sum($numbers) / count($numbers) : 0;
    }

    /**
     * Calculate percentage
     */
    public static function percentage(int $current, int $total): float {
        return $total > 0 ? round(($current / $total) * 100, 2) : 0;
    }

    /**
     * Round to nearest
     */
    public static function roundToNearest(float $number, int $nearest = 5): float {
        return round($number / $nearest) * $nearest;
    }
}
