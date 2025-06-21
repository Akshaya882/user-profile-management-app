<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load Composer's autoloader and dotenv
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use MongoDB\Client as MongoClient;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// MySQL Connection
$host = $_ENV['DB_HOST'] ?? 'localhost';
$user = $_ENV['DB_USER'] ?? 'root';
$pass = $_ENV['DB_PASS'] ?? '';
$dbname = $_ENV['DB_NAME'] ?? 'guvi_intern';
$port = $_ENV['DB_PORT'] ?? 3306;

$mysql_conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($mysql_conn->connect_error) {
    die("MySQL Connection failed: " . $mysql_conn->connect_error);
}

// Receive data from AJAX
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
$dob = $_POST['dob'] ?? '';
$contact = $_POST['contact'] ?? '';

// Insert into MySQL
$stmt = $mysql_conn->prepare("INSERT INTO users (username, email, password, dob, contact) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $username, $email, $password, $dob, $contact);

if (!$stmt->execute()) {
    echo "MySQL Error: " . $stmt->error;
    $stmt->close();
    $mysql_conn->close();
    exit;
}
$stmt->close();
$mysql_conn->close();

// Insert into MongoDB
try {
    $mongoClient = new MongoClient("mongodb://127.0.0.1:27017");
    $mongoDB = $mongoClient->guvi_intern;
    $collection = $mongoDB->profiles;

    $collection->insertOne([
        'email' => $email,
        'dob' => $dob,
        'contact' => $contact
    ]);

    echo "success";
} catch (Exception $e) {
    echo "MongoDB Error: " . $e->getMessage();
}
?>
