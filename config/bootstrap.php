<?php

/**
 * PeerSync Bootstrap Configuration (Professional Structure)
 * Initialize application on every request
 * 
 * This is the main entry point - loads all configuration and dependencies
 */

// Define application constants
define('APP_ROOT', dirname(__DIR__));
define('APP_NAME', 'PeerSync');
define('APP_ENV', $_ENV['APP_ENV'] ?? 'development');
define('APP_DEBUG', APP_ENV === 'development');

// Define common paths
define('BASE_PATH', APP_ROOT);
define('APP_PATH', APP_ROOT . '/app');
define('CONFIG_PATH', APP_ROOT . '/config');
define('DATABASE_PATH', APP_ROOT . '/database');
define('STORAGE_PATH', APP_ROOT . '/storage');
define('PUBLIC_PATH', APP_ROOT . '/public');
define('TESTS_PATH', APP_ROOT . '/tests');

// Error handling
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', '0');
}

// Timezone
date_default_timezone_set('UTC');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set JSON response header for API routes
if (strpos($_SERVER['REQUEST_URI'], '/api') !== false) {
    header('Content-Type: application/json');
}

// CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

/**
 * PSR-4 Autoloader
 * Automatically loads classes from app/ directory
 * 
 * Usage:
 * use App\Models\User;
 * use App\Services\AuthService;
 */
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $len = strlen($prefix);
    
    // Check if class uses our namespace
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    // Get relative class name
    $relative_class = substr($class, $len);
    
    // Convert namespace to file path
    $file = APP_PATH . '/' . str_replace('\\', '/', $relative_class) . '.php';
    
    // Require file if it exists
    if (file_exists($file)) {
        require $file;
    }
});

// Load environment variables (optional)
if (file_exists(CONFIG_PATH . '/.env')) {
    $env = parse_ini_file(CONFIG_PATH . '/.env');
    foreach ($env as $key => $value) {
        $_ENV[$key] = $value;
    }
}

// Load config files
// require_once CONFIG_PATH . '/app.php';
// require_once CONFIG_PATH . '/database.php';

// Application is ready!
