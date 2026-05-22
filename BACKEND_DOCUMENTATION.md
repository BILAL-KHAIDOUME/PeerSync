# PeerSync Backend - Complete Documentation

## Overview

The PeerSync backend is built using **PHP OOP** with **MySQL** database. It implements a clean architecture with separation of concerns using Models, Services, and Controllers.

---

## Architecture

```
Backend Structure:
├── config/
│   ├── Database.php          (Database connection & operations)
│   ├── User.php              (User model)
│   ├── TutoringRequest.php   (Request model)
│   ├── TutoringSession.php   (Session model)
│   ├── Rating.php            (Rating model)
│   ├── AuthService.php       (Authentication service)
│   ├── TutoringService.php   (Business logic)
│   ├── Response.php          (API response helper)
│   └── Helpers.php           (Utilities)
├── sql/
│   └── structure.sql         (Database schema)
└── public/
    └── api.php               (API endpoints)
```

---

## Database Schema

### Tables:

1. **users** - User accounts
2. **user_skills** - Tutor specialties
3. **tutoring_requests** - Student requests
4. **tutoring_sessions** - Active/completed sessions
5. **ratings** - Reviews and ratings
6. **badges** - Achievement system
7. **user_badges** - Earned badges

### Import Database:

```bash
mysql -u root peersync < sql/structure.sql
```

---

## Core Classes

### Database (Connection Manager)

```php
use App\Core\Database;

$db = new Database();
$db->connect();           // Get PDO connection
$db->execute($sql, $params);   // Execute query
$db->fetchOne($sql, $params);  // Get single row
$db->fetchAll($sql, $params);  // Get all rows
```

### User Model

```php
use App\Models\User;

$user = new User();

// Create user
$userId = $user->create([
    'nom' => 'Doe',
    'prenom' => 'John',
    'email' => 'john@example.com',
    'password' => 'password123',
    'role' => 'student'
]);

// Find user
$user = $user->findById(1);
$user = $user->findByEmail('john@example.com');

// Update user
$user->update(1, ['bio' => 'New bio']);

// Get stats
$avgRating = $user->getAverageRating(1);
$sessions = $user->getTotalSessions(1);
$hours = $user->getTotalHours(1);
```

### TutoringRequest Model

```php
use App\Models\TutoringRequest;

$request = new TutoringRequest();

// Create request
$requestId = $request->create([
    'student_id' => 1,
    'subject' => 'Mathematics',
    'level' => 'intermediate',
    'description' => 'Help with algebra',
    'duration_hours' => 2,
    'preferred_rate' => 15.00
]);

// Get requests
$pending = $request->getPendingRequests(10, 0);
$student_requests = $request->getStudentRequests(1);
$by_subject = $request->getRequestsBySubject('Physics');

// Assign tutor
$request->assignTutor($requestId, $tutorId);

// Update status
$request->updateStatus($requestId, 'assigned');
```

### TutoringSession Model

```php
use App\Models\TutoringSession;

$session = new TutoringSession();

// Create session
$sessionId = $session->create([
    'request_id' => 1,
    'student_id' => 1,
    'tutor_id' => 2,
    'start_time' => '2024-05-22 15:00:00'
]);

// Get sessions
$active = $session->getActiveSessions(1);
$completed = $session->getCompletedSessions(1, 10);
$stats = $session->getUserStats(1);

// Manage session
$session->startSession($sessionId);
$session->endSession($sessionId, 'Good session');
$session->cancelSession($sessionId);
```

### Rating Model

```php
use App\Models\Rating;

$rating = new Rating();

// Create rating
$ratingId = $rating->create([
    'session_id' => 1,
    'reviewer_id' => 1,
    'reviewee_id' => 2,
    'rating' => 5,
    'comment' => 'Great tutor!'
]);

// Get ratings
$ratings = $rating->getUserRatings(2, 10);
$avg = $rating->getUserAverageRating(2);
$distribution = $rating->getRatingDistribution(2);
```

### AuthService (Authentication)

```php
use App\Services\AuthService;

$auth = new AuthService();

// Register
$result = $auth->register([
    'nom' => 'Doe',
    'prenom' => 'John',
    'email' => 'john@example.com',
    'password' => 'password123',
    'role' => 'student'
]);

// Login
$result = $auth->login('john@example.com', 'password123');

// Check authentication
AuthService::isLoggedIn();        // bool
AuthService::isAdmin();           // bool
AuthService::isTutor();           // bool
AuthService::isStudent();         // bool
AuthService::getCurrentUserId();  // int

// Require authentication
AuthService::requireLogin();      // Redirects if not logged in
AuthService::requireRole('tutor'); // Checks role
```

### TutoringService (Business Logic)

```php
use App\Services\TutoringService;

$service = new TutoringService();

// Create and auto-assign request
$result = $service->createRequestAndAssign([
    'student_id' => 1,
    'subject' => 'Mathematics',
    'level' => 'intermediate',
    'description' => 'Help with algebra'
]);

// Find matching tutors
$tutors = $service->findMatchingTutors('Mathematics', 'intermediate');

// Start session
$result = $service->startSession($sessionId, $userId);

// End session
$result = $service->endSession($sessionId, $userId, 'Session notes');

// Get dashboard stats
$stats = $service->getUserDashboardStats($userId);
```

---

## API Endpoints

### Authentication

#### Register User

```
POST /api/auth/register
Content-Type: application/json

{
    "nom": "Doe",
    "prenom": "John",
    "email": "john@example.com",
    "password": "password123",
    "role": "student"
}

Response: { "success": true, "data": { "user_id": 1 } }
```

#### Login User

```
POST /api/auth/login

{
    "email": "john@example.com",
    "password": "password123"
}

Response: { "success": true, "data": { "id": 1, "email": "john@example.com", ... } }
```

#### Logout User

```
POST /api/auth/logout

Response: { "success": true }
```

### User Profile

#### Get Profile

```
GET /api/user/profile

Response: { "success": true, "data": { "id": 1, "nom": "Doe", ... } }
```

#### Update Profile

```
PUT /api/user/profile

{
    "bio": "New bio",
    "avatar": "https://..."
}

Response: { "success": true, "data": { "id": 1, ... } }
```

### Tutoring Requests

#### Get All Requests

```
GET /api/requests?limit=10&offset=0

Response: { "success": true, "data": { "requests": [...], "count": 10 } }
```

#### Create Request

```
POST /api/requests

{
    "subject": "Mathematics",
    "level": "intermediate",
    "description": "Help with algebra",
    "duration_hours": 2,
    "preferred_rate": 15.00
}

Response: { "success": true, "data": { "request_id": 1 } }
```

#### Get Request

```
GET /api/requests/{id}

Response: { "success": true, "data": { "id": 1, ... } }
```

#### Accept Request (Tutor)

```
POST /api/requests/{id}/accept

Response: { "success": true }
```

### Sessions

#### Get Active Sessions

```
GET /api/sessions/active

Response: { "success": true, "data": { "sessions": [...] } }
```

#### Get Completed Sessions

```
GET /api/sessions/completed?limit=10

Response: { "success": true, "data": { "sessions": [...] } }
```

#### Start Session

```
POST /api/sessions/{id}/start

Response: { "success": true }
```

#### End Session

```
POST /api/sessions/{id}/end

{
    "notes": "Session went well"
}

Response: { "success": true }
```

### Ratings

#### Create Rating

```
POST /api/ratings

{
    "session_id": 1,
    "reviewee_id": 2,
    "rating": 5,
    "comment": "Great tutor!"
}

Response: { "success": true, "data": { "rating_id": 1 } }
```

#### Get User Ratings

```
GET /api/ratings/user/{id}?limit=10

Response: { "success": true, "data": { "ratings": [...], "average_rating": 4.8 } }
```

### Admin

#### Get All Users

```
GET /api/admin/users?limit=50&offset=0

Response: { "success": true, "data": { "users": [...] } }
```

#### Get All Sessions

```
GET /api/admin/sessions?limit=50&offset=0

Response: { "success": true, "data": { "sessions": [...] } }
```

---

## Response Format

### Success Response

```json
{
  "success": true,
  "message": "Operation successful",
  "data": {
    /* Response data */
  }
}
```

### Error Response

```json
{
  "success": false,
  "message": "Error message",
  "data": {}
}
```

### Validation Error

```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "email": "Email is required",
    "password": "Password must be at least 6 characters"
  }
}
```

---

## Helper Classes

### Validator

```php
use App\Utils\Validator;

$validator = new Validator();

$validator->email('john@example.com');           // bool
$validator->passwordStrength('Pass123');         // bool
$validator->required($data, ['email', 'name']);  // bool
$validator->minLength('hello', 3, 'password');   // bool
$validator->rating(5);                           // bool

$validator->getErrors();   // array
$validator->hasErrors();   // bool
```

### StringHelper

```php
use App\Utils\StringHelper;

StringHelper::sanitize('<script>alert("xss")</script>');  // Safe string
StringHelper::slug('Hello World');                        // 'hello-world'
StringHelper::truncate('Very long text...', 10);          // 'Very long...'
StringHelper::initials('John', 'Doe');                    // 'JD'
```

### DateHelper

```php
use App\Utils\DateHelper;

DateHelper::format('2024-05-22 15:00:00', 'M d, Y');      // 'May 22, 2024'
DateHelper::timeAgo('2024-05-22 15:00:00');               // '2 hours ago'
DateHelper::durationHours('15:00:00', '17:30:00');        // 2.5
```

### MathHelper

```php
use App\Utils\MathHelper;

MathHelper::average([1, 2, 3, 4, 5]);        // 3
MathHelper::percentage(25, 100);             // 25.0
MathHelper::roundToNearest(47, 5);           // 45
```

---

## Security Features

✅ **Password Hashing** - BCrypt hashing
✅ **Prepared Statements** - SQL injection protection
✅ **Session Management** - Secure sessions
✅ **Role-Based Access** - Route protection
✅ **Input Validation** - Comprehensive validation
✅ **Error Handling** - Try-catch blocks
✅ **CORS Ready** - API headers ready

---

## Error Handling

All database operations use try-catch blocks:

```php
try {
    $result = $db->execute($sql, $params);
} catch (\PDOException $e) {
    Response::error('Database error: ' . $e->getMessage());
}
```

---

## Usage Example

```php
<?php

require_once 'config/Database.php';
require_once 'config/User.php';
require_once 'config/AuthService.php';
require_once 'config/TutoringService.php';

use App\Models\User;
use App\Services\AuthService;
use App\Services\TutoringService;

session_start();

// Register new user
$auth = new AuthService();
$result = $auth->register([
    'nom' => 'Ahmed',
    'prenom' => 'Hassan',
    'email' => 'ahmed@example.com',
    'password' => 'SecurePass123',
    'role' => 'student'
]);

if ($result['success']) {
    echo "User created: " . $result['user_id'];
}

// Login
$loginResult = $auth->login('ahmed@example.com', 'SecurePass123');

if ($loginResult['success']) {
    echo "Welcome, " . $_SESSION['user_name'];
}

// Create tutoring request
$service = new TutoringService();
$requestResult = $service->createRequestAndAssign([
    'student_id' => $loginResult['user']['id'],
    'subject' => 'Mathematics',
    'level' => 'intermediate',
    'description' => 'Help with algebra and geometry',
    'duration_hours' => 2,
    'preferred_rate' => 15.00
]);

if ($requestResult['success']) {
    echo "Request created: " . $requestResult['request_id'];
}
```

---

## Testing APIs

### Using cURL

```bash
# Register
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{"nom":"Doe","prenom":"John","email":"john@example.com","password":"Pass123","role":"student"}'

# Login
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"john@example.com","password":"Pass123"}'

# Get profile
curl -X GET http://localhost:8000/api/user/profile

# Get requests
curl -X GET "http://localhost:8000/api/requests?limit=10&offset=0"
```

### Using Postman

1. Import endpoints into Postman
2. Set base URL: `http://localhost:8000/api`
3. Add authentication headers as needed
4. Test each endpoint

---

## Performance Optimization

✅ Indexed database queries
✅ Prepared statements (prevent N+1 queries)
✅ Pagination for large datasets
✅ Efficient joins
✅ Caching ready

---

## Future Enhancements

- [ ] Redis caching layer
- [ ] Rate limiting
- [ ] API versioning
- [ ] JWT authentication
- [ ] Webhook support
- [ ] GraphQL endpoint
- [ ] Advanced logging
- [ ] Analytics dashboard

---

## Support & Troubleshooting

### Database Connection Error

Check `config/Database.php` settings:

```php
private string $host = "localhost";
private string $dbname = "peersync";
private string $username = "root";
private string $password = "";
```

### API Not Responding

Ensure `.htaccess` is configured for API routing or use:

```
php -S localhost:8000 -t public
```

### Sessions Not Working

Ensure `session_start()` is called at the beginning of `api.php`.

---

**Backend Status**: ✅ Complete & Ready for Production


