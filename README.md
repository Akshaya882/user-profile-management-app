# Web Profile Management System

This is a full-stack web application built as part of a developer internship task. The app allows users to register, log in, view and update their profile, and maintain login sessions using browser-based storage. It uses a dual-database architecture — **MySQL** for authentication and **MongoDB** for profile data.

---

##  Features

###  User Registration
- Stores login information (email, hashed password) in **MySQL**
- Stores profile information (DOB, contact) in **MongoDB**

###  User Login
- Verifies credentials using **PHP and MySQL** (with prepared statements)
- Stores session in **browser localStorage** (not using PHP sessions)

###  User Profile
- Loads user profile from **MongoDB** after login
- Supports live update of profile fields using **AJAX**
- Displays user info dynamically on the profile page

###  Logout
- Clears localStorage session
- Redirects to login page

---

##  Tech Stack

- **Frontend**: HTML, CSS (Bootstrap), jQuery, AJAX  
- **Backend**: PHP  
- **Databases**:  
  - **MySQL** – For login credentials  
  - **MongoDB** – For profile data  
- **Tools**: XAMPP, MongoDB Compass, Composer, `.env` environment file

---

##  Folder Structure

```txt
user-profile-management-app/
├── index.html              → Login page
├── register.html           → Registration page
├── profile.html            → Profile view + update + logout
│
├── css/
│   └── style.css           → Custom styling
│
├── js/
│   ├── login.js            → AJAX for login
│   ├── register.js         → AJAX for registration
│   └── profile.js          → AJAX for profile load, update, logout
│
├── php/
│   ├── login.php           → Login backend with .env + MySQL
│   ├── register.php        → Registration backend (MySQL + MongoDB)
│   ├── profile.php         → Fetches user data from MongoDB
│   └── update.php          → Updates user profile in MongoDB
│
├── db/
│   ├── mysql.php           → MySQL DB connection using .env
│   └── mongo.php           → MongoDB connection using .env
│
├── vendor/                 → Composer packages (for MongoDB + dotenv)
├── .env                    → Environment config for DB credentials
├── composer.json           → Composer config file
└── README.md               → Project documentation
```

---

##  How to Run This Project Locally

### 1. Install Required Tools

- XAMPP (Apache + MySQL)  
- MongoDB (with MongoDB Compass)  
- Composer (PHP package manager)

### 2. Set Up MySQL Database

Visit `http://localhost/phpmyadmin`, and run:

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

### 3. Set Up `.env` File

Create a `.env` file in your root directory:

```env
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=guvi_intern
DB_PORT=3306

MONGO_URI=mongodb://127.0.0.1:27017
```

> Change ports/user/passwords as needed based on your system setup.

### 4. Start the Servers

- Open **XAMPP** → Start Apache + MySQL  
- Open a terminal → Run `mongod` (to start MongoDB server)

### 5. Open the App

- Register:  
  `http://localhost/user-profile-management-app/register.html`
- Login:  
  `http://localhost/user-profile-management-app/index.html`
- Profile:  
  `http://localhost/user-profile-management-app/profile.html`

---

##  Mobile & Desktop View Testing

To test the app on your mobile device:

1. Connect mobile and PC to the **same Wi-Fi network**
2. Find your PC's **local IP** (e.g., `192.168.1.4`)
3. On your mobile browser, visit:

   ```
   http://192.168.1.4/user-profile-management-app/register.html
   ```

> Make sure firewall allows access and Apache is running.

---

##  Guidelines Followed

- Modular structure with separate folders for PHP, JS, CSS, DB  
- All user interactions handled via **AJAX** (no form submit reloads)  
- Uses `.env` securely to store DB credentials  
- MongoDB + MySQL integrated together  
- Passwords are securely **hashed** using `password_hash()`  
- Fully tested on **both desktop and mobile**

---

##  Author

Created by **Akshaya N**  
As part of an internship task submission and learning project.
