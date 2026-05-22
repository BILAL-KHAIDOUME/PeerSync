-- Active: 1779209372691@@127.0.0.1@3306@peersync
CREATE DATABASE IF NOT EXISTS peersync;

USE peersync;

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('student','tutor','admin') NOT NULL DEFAULT 'student',
    points INT DEFAULT 0,
    bio TEXT,
    avatar VARCHAR(255),
    verified BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- User Skills/Specialties (for tutors)
CREATE TABLE user_skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    skill_name VARCHAR(100) NOT NULL,
    experience_level ENUM('beginner','intermediate','advanced') DEFAULT 'intermediate',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tutoring Requests
CREATE TABLE tutoring_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    subject VARCHAR(150) NOT NULL,
    level ENUM('beginner','intermediate','advanced') NOT NULL,
    description TEXT NOT NULL,
    status ENUM('pending','assigned','in_progress','completed','cancelled') DEFAULT 'pending',
    duration_hours INT,
    preferred_rate DECIMAL(10, 2),
    preferred_date_time DATETIME,
    assigned_tutor_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (assigned_tutor_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Tutoring Sessions
CREATE TABLE tutoring_sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    request_id INT NOT NULL,
    student_id INT NOT NULL,
    tutor_id INT NOT NULL,
    start_time DATETIME NOT NULL,
    end_time DATETIME,
    duration_minutes INT,
    status ENUM('scheduled','in_progress','completed','cancelled') DEFAULT 'scheduled',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (request_id) REFERENCES tutoring_requests(id) ON DELETE CASCADE,
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (tutor_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Ratings & Reviews
CREATE TABLE ratings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    session_id INT NOT NULL,
    reviewer_id INT NOT NULL,
    reviewee_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (session_id) REFERENCES tutoring_sessions(id) ON DELETE CASCADE,
    FOREIGN KEY (reviewer_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (reviewee_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Badges/Achievements
CREATE TABLE badges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    icon VARCHAR(255),
    criteria_type ENUM('sessions','hours','rating','points') NOT NULL,
    criteria_value INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- User Badges (earned by users)
CREATE TABLE user_badges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    badge_id INT NOT NULL,
    earned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (badge_id) REFERENCES badges(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_badge (user_id, badge_id)
);

-- Create Indexes for performance
CREATE INDEX idx_user_role ON users(role);
CREATE INDEX idx_user_email ON users(email);
CREATE INDEX idx_request_student ON tutoring_requests(student_id);
CREATE INDEX idx_request_tutor ON tutoring_requests(assigned_tutor_id);
CREATE INDEX idx_request_status ON tutoring_requests(status);
CREATE INDEX idx_session_student ON tutoring_sessions(student_id);
CREATE INDEX idx_session_tutor ON tutoring_sessions(tutor_id);
CREATE INDEX idx_session_status ON tutoring_sessions(status);
CREATE INDEX idx_rating_reviewer ON ratings(reviewer_id);
CREATE INDEX idx_rating_reviewee ON ratings(reviewee_id);