<?php
session_start();

include 'connection.php';

if (isset($_SESSION['u_id'])) {
    $user_id = $_SESSION['u_id'];

    // Get the uploaded image data
    $image = file_get_contents($_FILES['user_images']['tmp_name']);
    $content_type = $_FILES['user_images']['type'];

    // Check if the user already has an image stored in the database
    $stmt = $conn->prepare("SELECT * FROM user_images WHERE u_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the existing user image
        $stmt = $conn->prepare("UPDATE user_images SET images = ?, contentType = ? WHERE u_id = ?");
        $stmt->bind_param('ssi', $image, $content_type, $user_id);
        $stmt->execute();
    } else {
        // Insert a new user image
        $stmt = $conn->prepare("INSERT INTO user_images (u_id, images, contentType) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $user_id, $image, $content_type);
        $stmt->execute();
    }

    header('Location: profile.php');
}
?>
