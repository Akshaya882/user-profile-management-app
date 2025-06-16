# Web Profile Management System

This is a full-stack web application built as part of a developer internship task. The app allows users to register, log in, view and update their profile, and maintain login sessions using browser-based storage and dual-database architecture (MySQL + MongoDB).

---

## Features

### User Registration
- Stores user login information (email and hashed password) in **MySQL**
- Stores user profile information (DOB and contact) in **MongoDB**

### User Login
- Verifies user credentials using **PHP and MySQL** (with prepared statements)
- Stores login session in **browser localStorage**
- Does not use PHP sessions

### User Profile
- Fetches profile data from **MongoDB**
- Allows editing and updating profile via AJAX
- Displays personalized user details post-login

### Logout
- Clears session from browser `localStorage`
- Redirects to login page

---

## Tech Stack

- **Frontend**: HTML, CSS (Bootstrap), jQuery, AJAX
- **Backend**: PHP
- **Databases**:
  - **MySQL** – Stores user login credentials
  - **MongoDB** – Stores user profile information
- **Tools**: XAMPP, MongoDB Compass, Composer

---

## Folder Structure

```txt
user-profile-management-app/
├── index.html              → Login page
├── register.html           → Registration page
├── profile.html            → Profile view + update + logout
│
├── js/
│   ├── login.js            → AJAX for login
│   ├── register.js         → AJAX for registration
│   └── profile.js          → AJAX for profile load, update, logout
│
├── php/
│   ├── login.php           → Backend login validation
│   ├── register.php        → Stores user in MySQL & profile in MongoDB
│   ├── profile.php         → Loads profile data from MongoDB
│   └── update.php          → Updates profile in MongoDB
│
├── db/
│   ├── mysql.php           → Connects to MySQL
│   └── mongo.php           → Connects to MongoDB
│ 
├── vendor/                 → Composer auto-loaded packages (MongoDB)
│   ├── autoload.php
│   └── ...
│
├── composer.json           → MongoDB dependency config
└── README.md               → Project documentation

## How to Run This Project Locally

1. **Install Required Tools**:
   - XAMPP (start Apache + MySQL)
   - MongoDB (with MongoDB Compass)
   - Composer (to install `mongodb/mongodb` package)

2. **Set Up MySQL Database**:
   - Open `phpMyAdmin` at:  
     `http://localhost/phpmyadmin`
   - Run the following SQL commands:

     ```sql
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
     ```

3. **Start the Servers**:
   - Start Apache and MySQL from XAMPP control panel
   - Open Command Prompt and run:
     ```
     mongod
     ```

4. **Open the App in Browser**:
   - Registration page:  
     `http://localhost/user-profile-management-app/register.html`
   - Login page:  
     `http://localhost/user-profile-management-app/index.html`
   - Profile page (after login):  
     `http://localhost/user-profile-management-app/profile.html`

## Guidelines Followed 

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