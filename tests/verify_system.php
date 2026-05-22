<?php

/**
 * PeerSync System Verification Script
 * Checks if everything is properly configured
 */

echo "========================================\n";
echo "✅ PeerSync System Verification\n";
echo "========================================\n\n";

$issues = [];
$checks = [];

// Check 1: Database connection
echo "Checking database connection...\n";
try {
    $pdo = new PDO('mysql:host=localhost;dbname=peersync;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $checks['Database Connection'] = '✅ OK';
    echo "✅ Database connected\n";
} catch (PDOException $e) {
    $checks['Database Connection'] = '❌ FAILED';
    $issues[] = "Database connection failed: " . $e->getMessage();
    echo "❌ Database connection failed\n";
}

// Check 2: Required PHP files exist
echo "\nChecking required files...\n";
$requiredFiles = [
    'config/Database.php' => 'Database connection manager',
    'config/User.php' => 'User model',
    'config/AuthService.php' => 'Authentication service',
    'config/Response.php' => 'Response helper',
    'config/TutoringRequest.php' => 'Request model',
    'config/TutoringSession.php' => 'Session model',
    'config/Rating.php' => 'Rating model',
    'config/TutoringService.php' => 'Tutoring service',
    'config/Helpers.php' => 'Helper utilities',
    'public/api.php' => 'API router',
    'public/register.php' => 'Registration page',
    'public/login.php' => 'Login page',
    'bootstrap.php' => 'Bootstrap config'
];

$missingFiles = [];
foreach ($requiredFiles as $file => $desc) {
    if (file_exists($file)) {
        echo "✅ $file ($desc)\n";
    } else {
        echo "❌ $file (MISSING)\n";
        $missingFiles[] = $file;
        $issues[] = "Missing file: $file";
    }
}

// Check 3: Database tables
if (!isset($issues[0]) || strpos($issues[0], 'Database') === false) {
    echo "\nChecking database tables...\n";
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=peersync;charset=utf8mb4', 'root', '');
        $result = $pdo->query("SHOW TABLES");
        $tables = $result->fetchAll(PDO::FETCH_COLUMN);
        
        $requiredTables = ['users', 'tutoring_requests', 'tutoring_sessions', 'ratings', 'user_skills', 'badges', 'user_badges'];
        foreach ($requiredTables as $table) {
            if (in_array($table, $tables)) {
                echo "✅ $table\n";
            } else {
                echo "❌ $table (MISSING)\n";
                $issues[] = "Missing table: $table";
            }
        }
        $checks['Database Tables'] = count(array_diff($requiredTables, $tables)) === 0 ? '✅ OK' : '❌ MISSING';
    } catch (Exception $e) {
        echo "❌ Could not check tables: " . $e->getMessage() . "\n";
    }
}

// Check 4: Method existence
echo "\nChecking required methods...\n";
try {
    require_once 'config/User.php';
    require_once 'config/Database.php';
    
    $reflectionClass = new ReflectionClass('App\Models\User');
    $methods = $reflectionClass->getMethods();
    $methodNames = array_map(function($m) { return $m->getName(); }, $methods);
    
    $requiredMethods = ['create', 'findByEmail', 'emailExists', 'findById', 'verifyPassword', 'update'];
    foreach ($requiredMethods as $method) {
        if (in_array($method, $methodNames)) {
            echo "✅ User::$method()\n";
        } else {
            echo "❌ User::$method() (MISSING)\n";
            $issues[] = "Missing method: User::$method()";
        }
    }
} catch (Exception $e) {
    echo "⚠️  Could not verify methods: " . $e->getMessage() . "\n";
}

// Check 5: API endpoint accessibility
echo "\nChecking API endpoint...\n";
echo "To test: curl http://localhost:8000/api/auth/register\n";
echo "Make sure server is running: php -S localhost:8000 -t public\n";

// Summary
echo "\n========================================\n";
echo "📊 Verification Summary\n";
echo "========================================\n\n";

foreach ($checks as $check => $status) {
    echo "$check: $status\n";
}

if (!empty($missingFiles)) {
    echo "\nMissing Files: " . count($missingFiles) . "\n";
    foreach ($missingFiles as $file) {
        echo "  - $file\n";
    }
}

if (empty($issues)) {
    echo "\n✅ All checks passed! System is ready.\n";
    echo "\nQuick Start:\n";
    echo "1. php -S localhost:8000 -t public\n";
    echo "2. Visit http://localhost:8000/register.php\n";
    echo "3. Try registering an account\n";
} else {
    echo "\n❌ Issues found:\n";
    foreach ($issues as $issue) {
        echo "  - $issue\n";
    }
    echo "\nFix steps:\n";
    if (in_array('Database connection failed', implode(' ', $issues))) {
        echo "1. Make sure MySQL is running\n";
        echo "2. Import database: mysql -u root < sql/structure.sql\n";
    }
    if (!empty(array_filter($missingFiles))) {
        echo "2. Create missing files from documentation\n";
    }
}

echo "\n========================================\n";
