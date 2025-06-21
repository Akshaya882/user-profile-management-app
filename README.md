# Web Profile Management System

This is a full-stack web application developed as part of a developer internship task. The application allows users to register, log in, view, and update their profile while maintaining login sessions using browser-based storage. It follows a dual-database architecture using MySQL for authentication and MongoDB for profile information.

---

## Features

### User Registration
- Stores user credentials (email and hashed password) in MySQL.
- Stores user profile details (DOB and contact number) in MongoDB.

### User Login
- Validates user credentials using PHP and MySQL (with prepared statements).
- Maintains login session using browser localStorage (no PHP session).

### User Profile
- Fetches and displays user profile from MongoDB post-login.
- Supports editing and updating of profile via AJAX.

### Logout
- Clears the localStorage session and redirects the user to the login page.

---

## Technology Stack

- **Frontend**: HTML, CSS (Bootstrap), jQuery, AJAX
- **Backend**: PHP
- **Databases**:
  - MySQL – stores login data
  - MongoDB – stores profile information
- **Development Tools**: XAMPP, MongoDB Compass, Composer, dotenv (.env)

---

## Folder Structure
```txt
user-profile-management-app/
├── index.html              → Login page
├── register.html           → Registration page
├── profile.html            → Profile view and update page
│
├── css/
│   └── style.css           → Custom CSS styling
│
├── js/
│   ├── login.js            → Handles login AJAX
│   ├── register.js         → Handles registration AJAX
│   └── profile.js          → Handles profile fetch/update/logout
│
├── php/
│   ├── login.php           → Login backend with MySQL
│   ├── register.php        → Handles registration (MySQL + MongoDB)
│   ├── profile.php         → Loads user profile from MongoDB
│   └── update.php          → Updates user profile in MongoDB
│
├── db/
│   ├── mysql.php           → MySQL connection using dotenv
│   └── mongo.php           → MongoDB connection using dotenv
│
├── vendor/                 → Composer dependencies
├── .env                    → Environment configuration
├── composer.json           → Composer package file
└── README.md               → Project documentation

## How to Run This Project Locally

### 1. Install Prerequisites
- Install and configure **XAMPP** (start Apache and MySQL)
- Install **MongoDB** and **MongoDB Compass**
- Install **Composer** globally on your system

### 2. Configure MySQL
- Open [phpMyAdmin](http://localhost/phpmyadmin)
- Run the following SQL script:

- sql
CREATE DATABASE guvi_intern;
USE guvi_intern;
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(100),
  dob DATE,
  contact VARCHAR(20)
);

### 3. Create `.env` File
Create a `.env` file in the root directory of your project and add the following content:
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=guvi_intern
DB_PORT=3306

MONGO_URI=mongodb://127.0.0.1:27017

### Start the Servers**:
   - Start Apache and MySQL from XAMPP control panel
   - Open Command Prompt and run:
     ```
     mongod
     ```

### Open the App in Browser**:
   - Registration page:  
     `http://localhost/user-profile-management-app/register.html`
   - Login page:  
     `http://localhost/user-profile-management-app/index.html`
   - Profile page (after login):  
     `http://localhost/user-profile-management-app/profile.html`

### Guidelines Followed 

- All files separated (HTML, JS, PHP)
- No form submission — only AJAX used
- Session maintained using localStorage
- Redis used in backend for session validation
- MySQL + MongoDB used correctly
- Composer used for MongoDB driver
- Passwords hashed (not stored in plain text)

---

---

## Author

Created by Akshaya N as part of an internship evaluation task.
