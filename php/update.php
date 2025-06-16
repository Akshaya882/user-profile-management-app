<?php
require '../db/mongo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $contact = $_POST['contact'] ?? '';

    if ($username !== '') {
        $result = $profileCollection->updateOne(
            ['username' => $username],
            ['$set' => [
                'email' => $email,
                'dob' => $dob,
                'contact' => $contact
            ]]
        );

        if ($result->getMatchedCount() > 0) {
            if ($result->getModifiedCount() > 0) {
                echo "Profile updated successfully!";
            } else {
                echo "No changes made. Same values.";
            }
        } else {
            echo "Username not found in MongoDB.";
        }
    } else {
        echo "Username is missing in request.";
    }
} else {
    echo "Invalid request method.";
}
?>
