<?php
require __DIR__ . '/../vendor/autoload.php'; // Composer autoload

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");

// Database: guvi_profiles
// Collection: profiles
$mongoDB = $mongoClient->guvi_profiles;
$profileCollection = $mongoDB->profiles;
?>
