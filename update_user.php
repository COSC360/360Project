<?php
session_start();

header('Content-Type: application/json');
include 'connection.php';

if (isset($_SESSION['u_id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['u_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $bio = $_POST['profile_bio'];

    // Update user data in the database
    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, bio = ? WHERE u_id = ?");
    $stmt->bind_param('sssi', $username, $email, $bio, $user_id);
    $result = $stmt->execute();

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
