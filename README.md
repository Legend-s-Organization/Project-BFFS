# Project PAWS: Permit & Activity Workflow System

### Implementation & Deployment Guide for University IT

## 📋 1. Overview

Project PAWS is a secure, full-stack permit management system developed for National University (NU East Ortigas). It automates the student permit request process, including document uploads, real-time status tracking, and administrative oversight.

---

## 🛠️ 2. Technology Stack

- **Frontend:** HTML5, CSS3, Vanilla JavaScript
- **Backend:** PHP 8.0+ (API-Driven Architecture)
- **Database:** MySQL 5.7+ / MariaDB 10.4+
- **Connectivity:** fetch API with JSON-based communication

---

## 🚀 3. Deployment Instructions

### A. Server Configuration

1. Ensure the server supports **PHP 8.0 or higher**.
2. Enable the **PDO MySQL** extension in `php.ini`.
3. Set the project folder as a sub-directory in the web root (e.g., `/Project-BFFS/`).

### B. Database Setup

1. Create a new database named `university_paws`.
2. Execute the SQL script located at:
   `Project-BFFS/backend/database/schema.sql`
   _This script initializes the `users`, `permits`, and `permit_files` tables with proper relational constraints._

### C. Environment Settings

Configure your server-specific database credentials in:
`Project-BFFS/backend/config/config.php`

```php
define('DB_HOST', 'your_host');
define('DB_NAME', 'university_paws');
define('DB_USER', 'your_user');
define('DB_PASS', 'your_password');
```

### D. File System Permissions

The server must have **Read/Write** permissions for the following directory to store uploaded student documents:
`Project-BFFS/uploads/`

---

## 🔑 4. Initial Administrator Setup (Bootstrap)

To create the very first administrator account, run the following SQL command in your database management tool:

```sql
-- Replace 'YourID' and 'YourHash' accordingly.
-- Secure password hashes should be generated via PHP's password_hash() function.
INSERT INTO users (student_id, password, role) VALUES ('Admin', 'BCRYPT_HASH_HERE', 'admin');
```

---

## 🔒 5. Security & Maintenance

- **Prepared Statements:** All database interactions utilize PDO Prepared Statements to mitigate SQL Injection risks.
- **Data Protection:** User passwords are encrypted using the Bcrypt hashing algorithm.
- **Relational Integrity:** The system uses Foreign Key constraints with `ON DELETE CASCADE` to ensure that deleting a user automatically cleans up their related permits and files.
- **Modular Design:** The backend is organized into a clean API structure (`/backend/api/`), allowing for easy integration with university-wide Single Sign-On (SSO) systems if required in the future.

---

_University Project - NU East Ortigas (2026)_
