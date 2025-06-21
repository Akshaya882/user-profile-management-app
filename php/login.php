<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load Composer autoload and environment variables
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Connect to MySQL using environment variables
$mysql_conn = new mysqli(
    $_ENV['DB_HOST'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASS'],
    $_ENV['DB_NAME'],
    $_ENV['DB_PORT']
);

// Check for connection errors
if ($mysql_conn->connect_error) {
    die("Connection failed: " . $mysql_conn->connect_error);
}

// Get login credentials from AJAX request
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and execute query to fetch hashed password
$stmt = $mysql_conn->prepare("SELECT password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    // Verify the password using password_verify
    if (password_verify($password, $row['password'])) {
        echo "success";
    } else {
        echo "Invalid credentials";
    }
} else {
    echo "Invalid credentials";
}

// Close connections
$stmt->close();
$mysql_conn->close();
?>
