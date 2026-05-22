# 📁 PeerSync - Professional Structure Implementation

## Complete File Mapping & Migration

### ✅ STEP-BY-STEP REORGANIZATION

---

## PHASE 1: CREATE DIRECTORIES

```powershell
# Run in project root
cd C:\Users\bkhai\Documents\GitHub\PeerSync

# Create app structure
mkdir app\models
mkdir app\services
mkdir app\middleware
mkdir app\controllers
mkdir app\utils

# Create public structure
mkdir public\api
mkdir public\pages
mkdir public\assets
mkdir public\assets\css
mkdir public\assets\js
mkdir public\assets\images

# Create database structure
mkdir database\migrations
mkdir database\seeds

# Create storage structure
mkdir storage\logs
mkdir storage\cache
mkdir storage\sessions

# Create tests structure
mkdir tests\unit
mkdir tests\integration

# Create docs folder
mkdir docs
```

---

## PHASE 2: FILE MIGRATIONS

### Move Backend Models → app/models/

```
FROM                          TO
config/Database.php      →    app/models/Database.php
config/User.php          →    app/models/User.php
config/TutoringRequest.php → app/models/TutoringRequest.php
config/TutoringSession.php → app/models/TutoringSession.php
config/Rating.php        →    app/models/Rating.php
```

### Move Services → app/services/

```
FROM                          TO
config/AuthService.php   →    app/services/AuthService.php
config/TutoringService.php → app/services/TutoringService.php
config/Response.php      →    app/services/ResponseService.php
```

### Move Utilities → app/utils/

```
FROM                          TO
config/Helpers.php       →    app/utils/Helpers.php
```

### Move Frontend Pages → public/pages/

```
FROM                          TO
public/index.php         →    public/pages/index.php
public/login.php         →    public/pages/login.php
public/register.php      →    public/pages/register.php
public/student_dashboard.php → public/pages/student_dashboard.php
public/tutor_dashboard.php → public/pages/tutor_dashboard.php
public/tutor_browse_requests.php → public/pages/tutor_browse_requests.php
public/tutoring_session.php → public/pages/tutoring_session.php
public/admin_dashboard.php → public/pages/admin_dashboard.php
```

### Move API → public/api/

```
FROM                          TO
public/api.php           →    public/api/routes.php
```

### Move Database → database/

```
FROM                          TO
sql/structure.sql        →    database/schema.sql
```

### Move Tests → tests/

```
FROM                          TO
test_registration.php    →    tests/integration/registration_test.php
verify_system.php        →    tests/verify_system.php
```

### Move Documentation → docs/

```
FROM                          TO
*.md files in root       →    docs/*.md
```

---

## PHASE 3: CREATE NEW ENTRY POINTS

### Create public/index.php (Main Entry Point)

```php
<?php
/**
 * PeerSync - Main Entry Point
 * Routes requests to appropriate handlers
 */

require_once dirname(__DIR__) . '/config/bootstrap.php';

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_method = $_SERVER['REQUEST_METHOD'];

// Remove leading slash
$request_path = ltrim($request_uri, '/');

// Route API requests
if (strpos($request_path, 'api/') === 0) {
    require_once __DIR__ . '/api/routes.php';
    exit;
}

// Route page requests
$page = $request_path ?: 'index';
$page = str_replace('.php', '', $page); // Remove .php if present
$page_file = __DIR__ . "/pages/{$page}.php";

if (file_exists($page_file) && is_file($page_file)) {
    require $page_file;
} else {
    http_response_code(404);
    include __DIR__ . '/pages/404.php';
}
?>
```

### Create public/api/routes.php

```php
<?php
/**
 * API Routes Handler
 * Routes all /api/* requests to appropriate service
 */

require_once dirname(__DIR__, 2) . '/config/bootstrap.php';

use App\Services\AuthService;
use App\Services\ResponseService;
use App\Models\User;

// Get request method and path
$request_method = $_SERVER['REQUEST_METHOD'];
$request_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_path = str_replace('/api', '', $request_path);

try {
    // Auth Routes
    if ($request_path === '/auth/register' && $request_method === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        $auth = new AuthService();
        $result = $auth->register($data);

        if ($result['success']) {
            ResponseService::success(['user_id' => $result['user_id']], $result['message']);
        } else {
            ResponseService::error($result['message']);
        }
    }

    // Add more routes here...

    // Route not found
    ResponseService::notFound('API endpoint not found');

} catch (Exception $e) {
    ResponseService::error('Server error: ' . $e->getMessage(), 500);
}
?>
```

### Create public/pages/404.php

```php
<!DOCTYPE html>
<html>
<head>
    <title>404 - Page Not Found</title>
    <style>
        body { font-family: Arial; text-align: center; padding: 50px; }
        h1 { color: #0D9488; }
    </style>
</head>
<body>
    <h1>404 - Page Not Found</h1>
    <p>The requested page could not be found.</p>
    <a href="/">Go Home</a>
</body>
</html>
```

---

## PHASE 4: UPDATE INCLUDE PATHS

### In moved files, update all require_once statements:

**OLD STYLE:**

```php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../config/User.php';
use App\Models\User;
```

**NEW STYLE:**

```php
// No need! Autoloader handles it automatically
use App\Models\User;
use App\Services\AuthService;
```

Or if manually including:

```php
require_once __DIR__ . '/../../app/models/Database.php';
require_once __DIR__ . '/../../app/models/User.php';
```

---

## PHASE 5: CONFIGURATION FILES

### Keep in config/ (Configuration only):

```
config/
├── bootstrap.php              (Already updated)
├── database.php               (New - DB credentials)
├── app.php                    (New - App settings)
├── constants.php              (New - Constants)
└── routes.php                 (Optional - Route definitions)
```

### config/database.php

```php
<?php
// Database configuration
return [
    'host' => $_ENV['DB_HOST'] ?? 'localhost',
    'database' => $_ENV['DB_NAME'] ?? 'peersync',
    'username' => $_ENV['DB_USER'] ?? 'root',
    'password' => $_ENV['DB_PASS'] ?? '',
    'charset' => 'utf8mb4',
];
?>
```

### config/app.php

```php
<?php
// Application configuration
return [
    'name' => 'PeerSync',
    'version' => '1.0.0',
    'debug' => APP_DEBUG,
    'env' => APP_ENV,
    'timezone' => 'UTC',
];
?>
```

---

## PHASE 6: FINAL STRUCTURE

```
PeerSync/
├── app/
│   ├── models/
│   │   ├── Database.php
│   │   ├── User.php
│   │   ├── TutoringRequest.php
│   │   ├── TutoringSession.php
│   │   └── Rating.php
│   ├── services/
│   │   ├── AuthService.php
│   │   ├── TutoringService.php
│   │   └── ResponseService.php
│   ├── middleware/
│   │   ├── AuthMiddleware.php
│   │   └── RoleMiddleware.php
│   ├── controllers/
│   │   ├── AuthController.php
│   │   ├── UserController.php
│   │   └── RequestController.php
│   └── utils/
│       └── Helpers.php
│
├── config/
│   ├── bootstrap.php
│   ├── app.php
│   ├── database.php
│   └── constants.php
│
├── public/
│   ├── index.php               (NEW - Main entry point)
│   ├── api/
│   │   └── routes.php          (Moved from public/api.php)
│   ├── pages/
│   │   ├── index.php
│   │   ├── login.php
│   │   ├── register.php
│   │   ├── student_dashboard.php
│   │   ├── tutor_dashboard.php
│   │   ├── tutor_browse_requests.php
│   │   ├── tutoring_session.php
│   │   ├── admin_dashboard.php
│   │   └── 404.php             (NEW)
│   └── assets/
│       ├── css/
│       ├── js/
│       └── images/
│
├── database/
│   ├── schema.sql              (Moved from sql/structure.sql)
│   ├── migrations/
│   │   └── 2024_create_initial_schema.sql
│   └── seeds/
│       └── users.sql
│
├── storage/
│   ├── logs/
│   ├── cache/
│   └── sessions/
│
├── tests/
│   ├── unit/
│   ├── integration/
│   │   └── registration_test.php
│   └── verify_system.php
│
├── docs/
│   ├── API.md
│   ├── SETUP.md
│   ├── ARCHITECTURE.md
│   ├── DATABASE.md
│   └── ... (all other .md files)
│
├── .htaccess                   (Updated)
├── .gitignore                  (NEW)
└── README.md                   (Updated)
```

---

## PHASE 7: UPDATE .htaccess

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /

    # Route to public folder
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} !^/public
    RewriteRule ^(.*)$ public/$1 [L]

    # Handle clean URLs
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ public/index.php?url=$1 [QSA,L]
</IfModule>
```

---

## PHASE 8: TESTING

```bash
# Start server
php -S localhost:8000 -t public

# Test homepage
curl http://localhost:8000

# Test registration page
curl http://localhost:8000/register.php

# Test API
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{"nom":"Test","prenom":"User","email":"test@example.com","password":"Test123","role":"student"}'
```

---

## PHASE 9: CLEANUP

```bash
# After verifying everything works:

# Delete old structure (keep backups first!)
rm -r config/Database.php config/User.php config/TutoringRequest.php etc.
rm -r sql/

# Or keep old config folder structure as reference
```

---

## ✅ VERIFICATION CHECKLIST

- [ ] All directories created
- [ ] Files moved to correct locations
- [ ] Include paths updated
- [ ] public/index.php created
- [ ] public/api/routes.php created
- [ ] .htaccess updated
- [ ] bootstrap.php in config/
- [ ] All tests pass
- [ ] Registration works
- [ ] API endpoints work
- [ ] Frontend pages load
- [ ] Documentation in docs/

---

## 🚀 BENEFITS ACHIEVED

✅ Professional Laravel-style structure
✅ Clear separation: code → app/, config → config/, web → public/
✅ Easy to scale and maintain
✅ Industry standard organization
✅ Better security (only public/ exposed)
✅ Easier for team collaboration
✅ Clear where to add new features

---

This is now a **professional, enterprise-grade structure** ready for production! 🎉
