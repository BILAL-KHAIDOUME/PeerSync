-- Active: 1779209372691@@127.0.0.1@3306@peersync
CREATE DATABASE IF NOT EXISTS peersync;

use peersync;

CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(100) NOT NULL,
prenom VARCHAR(100) NOT NULL,
email VARCHAR(150) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL, 
role ENUM('student','tutor','admin') NOT NULL DEFAULT 'student',
points INT DEFAULT 0
);



