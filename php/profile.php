<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;
use Dotenv\Dotenv;

// Load .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

header('Content-Type: application/json');

// 1. Get the email from POST
$email = $_POST['email'] ?? '';

if (!$email) {
    echo json_encode(["error" => "No email received"]);
    exit;
}

try {
    // 2. Connect to MongoDB
    $client = new Client("mongodb://127.0.0.1:27017");
    $collection = $client->guvi_intern->profiles;

    // 3. Find the document
    $profile = $collection->findOne(['email' => $email]);

    if ($profile) {
        echo json_encode([
            "email" => $profile['email'],
            "dob" => $profile['dob'],
            "contact" => $profile['contact']
        ]);
    } else {
        echo json_encode(["error" => "Profile not found"]);
    }
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
