<?php
require '../db/mongo.php';

$username = $_POST['username'] ?? null;

if ($username) {
    $profile = $profileCollection->findOne(['username' => $username]);

    if ($profile) {
        echo json_encode([
            'email' => $profile['email'] ?? '',
            'dob' => $profile['dob'] ?? '',
            'contact' => $profile['contact'] ?? ''
        ]);
    } else {
        echo json_encode([
            'email' => '',
            'dob' => '',
            'contact' => ''
        ]);
    }
} else {
    echo json_encode([
        'email' => '',
        'dob' => '',
        'contact' => ''
    ]);
}
?>
