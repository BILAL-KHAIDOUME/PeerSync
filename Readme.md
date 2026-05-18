📚 Overview

PeerSync helps students request academic assistance and allows tutors to manage and validate tutoring sessions efficiently.

The platform aims to:

Simplify tutor-student collaboration
Organize tutoring requests
Track engagement and tutoring activity
Encourage knowledge sharing inside the ENAA community
✨ Features
👨‍🎓 Student Features
Authentication & role management
Create tutoring requests
Select subject categories/tags
Track request status
Validate completed tutoring sessions
Leave ratings & feedback
👨‍🏫 Tutor Features
Browse tutoring requests
Accept tutoring sessions
Manage active sessions
Earn points & badges
Appear on leaderboard rankings
🛠️ Admin Features
Dashboard & analytics
Tutor engagement tracking
Statistics management
Session monitoring
🧩 Project Structure
PeerSync/
│
├── app/
│   ├── controllers/
│   ├── models/
│   ├── views/
│   └── core/
│
├── public/
│
├── database/
│
├── routes/
│
├── assets/
│
└── README.md
🏗️ Architecture

This project follows the MVC Architecture:

Model → Handles database logic
View → User interface
Controller → Business logic & request handling
⚙️ Tech Stack
Backend
PHP 8+
MVC Architecture
PDO
MySQL
Frontend
HTML5
CSS3
JavaScript
Tools
Git & GitHub
Jira
UML Diagrams
🔐 Authentication System

The authentication module includes:

User registration
Secure login/logout
Role-based access control
Session management
📌 User Stories
Epic 1 — User & Profile Management
User authentication
Skill/tag management
Tutor profile customization
Epic 2 — Tutoring Request Workflow
Create tutoring requests
Request status management
Tutor assignment system
Epic 3 — Session Validation
Session completion workflow
Ratings & comments system
Epic 4 — Gamification
Badge & point system
Leaderboard ranking
Epic 5 — Administration
Engagement statistics
Activity monitoring dashboard
🗄️ Database

Main entities:

Users
Roles
Requests
Sessions
Reviews
Badges
Skills
🚀 Installation
1️⃣ Clone the repository
git clone https://github.com/your-username/PeerSync.git
2️⃣ Navigate into the project
cd PeerSync
3️⃣ Configure environment

Create your database and update your configuration file:

DB_HOST=localhost
DB_NAME=peersync
DB_USER=root
DB_PASS=
4️⃣ Import database

Import the SQL file into MySQL:

database/peersync.sql
5️⃣ Start local server

Using PHP built-in server:

php -S localhost:8000 -t public
📷 Screenshots

Add project screenshots here

![Dashboard](assets/screenshots/dashboard.png)
✅ Project Goals
Build a scalable tutoring platform
Practice MVC architecture
Improve backend development skills
Implement clean database relationships
Develop a real-world educational solution
📈 Future Improvements
Real-time chat system
Notifications
Video tutoring integration
Advanced analytics dashboard
Mobile responsive optimization
👨‍💻 Author

Khadija Makkaoui
Full Stack Web Developer

📄 License

This project is developed for educational purposes at ENAA Dev Web Bootcamp.

⭐ Support

If you like this project, feel free to:

Star the repository
Fork the project
Contribute with ideas or improvements