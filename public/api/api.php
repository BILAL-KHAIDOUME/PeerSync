<?php

/**
 * PeerSync API Routes
 * Main entry point for all API requests
 */

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../config/User.php';
require_once __DIR__ . '/../config/TutoringRequest.php';
require_once __DIR__ . '/../config/TutoringSession.php';
require_once __DIR__ . '/../config/Rating.php';
require_once __DIR__ . '/../config/AuthService.php';
require_once __DIR__ . '/../config/TutoringService.php';
require_once __DIR__ . '/../config/Response.php';
require_once __DIR__ . '/../config/Helpers.php';

use App\Core\Database;
use App\Core\Response;
use App\Models\User;
use App\Models\TutoringRequest;
use App\Models\TutoringSession;
use App\Models\Rating;
use App\Services\AuthService;
use App\Services\TutoringService;

// Start session
session_start();

// Get request method and path
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = str_replace('/api', '', $path);

// Route: POST /auth/register
if ($path === '/auth/register' && $method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $auth = new AuthService();
    $result = $auth->register($data);
    
    if ($result['success']) {
        Response::success(['user_id' => $result['user_id']], $result['message']);
    } else {
        Response::error($result['message']);
    }
}

// Route: POST /auth/login
if ($path === '/auth/login' && $method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (empty($data['email']) || empty($data['password'])) {
        Response::validationError(['email' => 'Email required', 'password' => 'Password required']);
    }
    
    $auth = new AuthService();
    $result = $auth->login($data['email'], $data['password']);
    
    if ($result['success']) {
        // Remove password from response
        unset($result['user']['password']);
        Response::success($result['user'], $result['message']);
    } else {
        Response::error($result['message']);
    }
}

// Route: POST /auth/logout
if ($path === '/auth/logout' && $method === 'POST') {
    AuthService::logout();
    Response::success([], 'Logged out successfully');
}

// Route: GET /user/profile
if ($path === '/user/profile' && $method === 'GET') {
    AuthService::requireLogin();
    
    $userId = AuthService::getCurrentUserId();
    $userModel = new User();
    $user = $userModel->findById($userId);
    
    if ($user) {
        unset($user['password']);
        Response::success($user);
    } else {
        Response::notFound('User not found');
    }
}

// Route: PUT /user/profile
if ($path === '/user/profile' && $method === 'PUT') {
    AuthService::requireLogin();
    
    $userId = AuthService::getCurrentUserId();
    $data = json_decode(file_get_contents('php://input'), true);
    
    $userModel = new User();
    if ($userModel->update($userId, $data)) {
        $user = $userModel->findById($userId);
        unset($user['password']);
        Response::success($user, 'Profile updated');
    } else {
        Response::error('Failed to update profile');
    }
}

// Route: GET /requests
if ($path === '/requests' && $method === 'GET') {
    AuthService::requireLogin();
    
    $requestModel = new TutoringRequest();
    $limit = $_GET['limit'] ?? 10;
    $offset = $_GET['offset'] ?? 0;
    
    $requests = $requestModel->getPendingRequests($limit, $offset);
    Response::success(['requests' => $requests, 'count' => count($requests)]);
}

// Route: POST /requests
if ($path === '/requests' && $method === 'POST') {
    AuthService::requireRole('student');
    
    $userId = AuthService::getCurrentUserId();
    $data = json_decode(file_get_contents('php://input'), true);
    
    $data['student_id'] = $userId;
    
    $service = new TutoringService();
    $result = $service->createRequestAndAssign($data);
    
    if ($result['success']) {
        Response::success(['request_id' => $result['request_id']], $result['message']);
    } else {
        Response::error($result['message']);
    }
}

// Route: GET /requests/{id}
if (preg_match('/^\/requests\/(\d+)$/', $path, $matches)) {
    $requestId = (int)$matches[1];
    $requestModel = new TutoringRequest();
    $request = $requestModel->findById($requestId);
    
    if ($request) {
        Response::success($request);
    } else {
        Response::notFound();
    }
}

// Route: GET /requests/student/{id}
if (preg_match('/^\/requests\/student\/(\d+)$/', $path, $matches)) {
    AuthService::requireLogin();
    
    $studentId = (int)$matches[1];
    $currentUserId = AuthService::getCurrentUserId();
    
    if ($studentId !== $currentUserId) {
        Response::forbidden();
    }
    
    $requestModel = new TutoringRequest();
    $requests = $requestModel->getStudentRequests($studentId);
    Response::success(['requests' => $requests]);
}

// Route: POST /requests/{id}/accept
if (preg_match('/^\/requests\/(\d+)\/accept$/', $path, $matches) && $method === 'POST') {
    AuthService::requireRole('tutor');
    
    $requestId = (int)$matches[1];
    $tutorId = AuthService::getCurrentUserId();
    
    $requestModel = new TutoringRequest();
    if ($requestModel->assignTutor($requestId, $tutorId)) {
        Response::success([], 'Request accepted');
    } else {
        Response::error('Failed to accept request');
    }
}

// Route: GET /sessions/active
if ($path === '/sessions/active' && $method === 'GET') {
    AuthService::requireLogin();
    
    $userId = AuthService::getCurrentUserId();
    $sessionModel = new TutoringSession();
    $sessions = $sessionModel->getActiveSessions($userId);
    
    Response::success(['sessions' => $sessions]);
}

// Route: GET /sessions/completed
if ($path === '/sessions/completed' && $method === 'GET') {
    AuthService::requireLogin();
    
    $userId = AuthService::getCurrentUserId();
    $limit = $_GET['limit'] ?? 10;
    
    $sessionModel = new TutoringSession();
    $sessions = $sessionModel->getCompletedSessions($userId, $limit);
    
    Response::success(['sessions' => $sessions]);
}

// Route: POST /sessions/{id}/start
if (preg_match('/^\/sessions\/(\d+)\/start$/', $path, $matches) && $method === 'POST') {
    AuthService::requireLogin();
    
    $sessionId = (int)$matches[1];
    $userId = AuthService::getCurrentUserId();
    
    $service = new TutoringService();
    $result = $service->startSession($sessionId, $userId);
    
    if ($result['success']) {
        Response::success([], $result['message']);
    } else {
        Response::error($result['message']);
    }
}

// Route: POST /sessions/{id}/end
if (preg_match('/^\/sessions\/(\d+)\/end$/', $path, $matches) && $method === 'POST') {
    AuthService::requireLogin();
    
    $sessionId = (int)$matches[1];
    $userId = AuthService::getCurrentUserId();
    
    $data = json_decode(file_get_contents('php://input'), true);
    $notes = $data['notes'] ?? null;
    
    $service = new TutoringService();
    $result = $service->endSession($sessionId, $userId, $notes);
    
    if ($result['success']) {
        Response::success([], $result['message']);
    } else {
        Response::error($result['message']);
    }
}

// Route: POST /ratings
if ($path === '/ratings' && $method === 'POST') {
    AuthService::requireLogin();
    
    $data = json_decode(file_get_contents('php://input'), true);
    $data['reviewer_id'] = AuthService::getCurrentUserId();
    
    $ratingModel = new Rating();
    $ratingId = $ratingModel->create($data);
    
    if ($ratingId) {
        Response::success(['rating_id' => $ratingId], 'Rating created');
    } else {
        Response::error('Failed to create rating');
    }
}

// Route: GET /ratings/user/{id}
if (preg_match('/^\/ratings\/user\/(\d+)$/', $path, $matches)) {
    $userId = (int)$matches[1];
    $limit = $_GET['limit'] ?? 10;
    
    $ratingModel = new Rating();
    $ratings = $ratingModel->getUserRatings($userId, $limit);
    $avgRating = $ratingModel->getUserAverageRating($userId);
    
    Response::success([
        'ratings' => $ratings,
        'average_rating' => round($avgRating, 1),
        'count' => count($ratings)
    ]);
}

// Route: GET /admin/users
if ($path === '/admin/users' && $method === 'GET') {
    AuthService::requireRole('admin');
    
    $limit = $_GET['limit'] ?? 50;
    $offset = $_GET['offset'] ?? 0;
    
    $userModel = new User();
    $users = $userModel->getAllTutors($limit, $offset);
    
    Response::success(['users' => $users]);
}

// Route: GET /admin/sessions
if ($path === '/admin/sessions' && $method === 'GET') {
    AuthService::requireRole('admin');
    
    $limit = $_GET['limit'] ?? 50;
    $offset = $_GET['offset'] ?? 0;
    
    $sessionModel = new TutoringSession();
    $sessions = $sessionModel->getAllSessions($limit, $offset);
    
    Response::success(['sessions' => $sessions]);
}

// 404 - Not Found
Response::notFound('Endpoint not found');
