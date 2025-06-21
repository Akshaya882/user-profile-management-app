<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;
use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

header('Content-Type: application/json');

// Read values from AJAX
$email = $_POST['email'] ?? '';
$dob = $_POST['dob'] ?? '';
$contact = $_POST['contact'] ?? '';

if (!$email || !$dob || !$contact) {
    echo json_encode(["error" => "Missing required fields."]);
    exit;
}

try {
    $mongoClient = new Client("mongodb://localhost:27017");
    $collection = $mongoClient->guvi_intern->profiles;

    $result = $collection->updateOne(
        ['email' => $email],
        ['$set' => ['dob' => $dob, 'contact' => $contact]]
    );

    if ($result->getModifiedCount() > 0) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => "No changes made or user not found."]);
    }
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
