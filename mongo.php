<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Composer autoload

try {
    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $mongoDB = $mongoClient->selectDatabase("guvi_intern");
    $mongoCollection = $mongoDB->selectCollection("user_profiles");
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "MongoDB connection failed: " . $e->getMessage()
    ]);
    exit();
}
?>
