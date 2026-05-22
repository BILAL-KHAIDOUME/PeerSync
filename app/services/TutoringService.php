<?php

namespace App\Services;

use App\Models\TutoringRequest;
use App\Models\TutoringSession;
use App\Models\User;

/**
 * Tutoring Service
 * Handles tutoring workflow logic
 */
class TutoringService {
    private TutoringRequest $requestModel;
    private TutoringSession $sessionModel;
    private User $userModel;

    public function __construct() {
        $this->requestModel = new TutoringRequest();
        $this->sessionModel = new TutoringSession();
        $this->userModel = new User();
    }

    /**
     * Create and auto-assign request to best tutor
     */
    public function createRequestAndAssign(array $data): array {
        try {
            $requestId = $this->requestModel->create($data);
            
            if (!$requestId) {
                return ['success' => false, 'message' => 'Failed to create request'];
            }

            // Try to find and assign best tutor
            $tutors = $this->findMatchingTutors($data['subject'], $data['level']);
            
            if (!empty($tutors)) {
                // Assign to top-rated tutor
                $bestTutor = $tutors[0];
                $this->requestModel->assignTutor($requestId, $bestTutor['id']);
                
                // Award points to student
                $this->userModel->addPoints($data['student_id'], 10);
                
                return [
                    'success' => true,
                    'message' => 'Request created and assigned',
                    'request_id' => $requestId,
                    'tutor_id' => $bestTutor['id']
                ];
            }

            return [
                'success' => true,
                'message' => 'Request created, awaiting tutor',
                'request_id' => $requestId
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Find tutors matching subject and level
     */
    public function findMatchingTutors(string $subject, string $level): array {
        // Get tutors with matching skills
        $sql = "SELECT u.*, AVG(r.rating) as avg_rating, COUNT(r.id) as rating_count
                FROM users u
                LEFT JOIN user_skills us ON u.id = us.user_id
                LEFT JOIN ratings r ON u.id = r.reviewee_id
                WHERE u.role = 'tutor' 
                AND (us.skill_name = :subject OR :subject = '')
                AND (us.experience_level >= :level OR :level = '')
                GROUP BY u.id
                ORDER BY avg_rating DESC, rating_count DESC
                LIMIT 10";
        
        $params = [':subject' => $subject, ':level' => $level];
        return (new \App\Core\Database())->fetchAll($sql, $params);
    }

    /**
     * Start tutoring session
     */
    public function startSession(int $sessionId, int $userId): array {
        $session = $this->sessionModel->findById($sessionId);

        if (!$session) {
            return ['success' => false, 'message' => 'Session not found'];
        }

        if ($session['student_id'] !== $userId && $session['tutor_id'] !== $userId) {
            return ['success' => false, 'message' => 'Unauthorized'];
        }

        if ($this->sessionModel->startSession($sessionId)) {
            return ['success' => true, 'message' => 'Session started'];
        }

        return ['success' => false, 'message' => 'Failed to start session'];
    }

    /**
     * End tutoring session
     */
    public function endSession(int $sessionId, int $userId, ?string $notes = null): array {
        $session = $this->sessionModel->findById($sessionId);

        if (!$session) {
            return ['success' => false, 'message' => 'Session not found'];
        }

        if ($session['tutor_id'] !== $userId) {
            return ['success' => false, 'message' => 'Only tutor can end session'];
        }

        if ($this->sessionModel->endSession($sessionId, $notes)) {
            // Award points
            $this->userModel->addPoints($session['tutor_id'], 25);
            $this->userModel->addPoints($session['student_id'], 15);
            
            // Mark request as completed
            $this->requestModel->updateStatus($session['request_id'], 'completed');

            return ['success' => true, 'message' => 'Session ended successfully'];
        }

        return ['success' => false, 'message' => 'Failed to end session'];
    }

    /**
     * Cancel request
     */
    public function cancelRequest(int $requestId, int $userId): array {
        $request = $this->requestModel->findById($requestId);

        if (!$request) {
            return ['success' => false, 'message' => 'Request not found'];
        }

        if ($request['student_id'] !== $userId) {
            return ['success' => false, 'message' => 'Unauthorized'];
        }

        if ($this->requestModel->cancel($requestId)) {
            return ['success' => true, 'message' => 'Request cancelled'];
        }

        return ['success' => false, 'message' => 'Failed to cancel request'];
    }

    /**
     * Get user dashboard stats
     */
    public function getUserDashboardStats(int $userId): array {
        $user = $this->userModel->findById($userId);
        $stats = $this->sessionModel->getUserStats($userId);
        $avgRating = $this->userModel->getAverageRating($userId);

        return [
            'user' => $user,
            'total_sessions' => $stats['total_sessions'],
            'total_hours' => $stats['total_hours'],
            'average_rating' => round($avgRating, 1),
            'points' => $user['points'] ?? 0
        ];
    }
}
