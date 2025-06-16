<?php
require '../db/mongo.php';

$host = "localhost";
$port = 3307;
$dbname = "guvi_intern";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$rawPassword = $_POST['password'];
$hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);
$email = $_POST['email'];
$dob = $_POST['dob'];
$contact = $_POST['contact'];

// Store login info in MySQL
$stmt = $conn->prepare("INSERT INTO users (username, password, email, dob, contact) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $username, $hashedPassword, $email, $dob, $contact);

if ($stmt->execute()) {
    // Store profile info in MongoDB
    $profileData = [
        'username' => $username,
        'email' => $email,
        'dob' => $dob,
        'contact' => $contact
    ];
    $profileCollection->insertOne($profileData);

    echo "Registered successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
