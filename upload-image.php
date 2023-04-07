<?php
session_start();

include 'connection.php';

if (isset($_SESSION['u_id'])) {
     $user_id = $_SESSION['u_id'];

     $stmt = $conn->prepare("SELECT * FROM users WHERE u_id = ?");
     $stmt->bind_param('i', $user_id);
     $stmt->execute();
     $user_data = $stmt->get_result()->fetch_assoc();

     $stmt = $conn->prepare("SELECT * FROM posts WHERE u_id = ? ORDER BY creation_time DESC LIMIT 5");
     $stmt->bind_param('i', $user_id);
     $stmt->execute();
    $recent_posts = $stmt->get_result();
}

if (isset($_FILES['image'])) {
    $image = $_FILES['image']['tmp_name'];
    $image = addslashes(file_get_contents($image));
    
    $stmt = $conn->prepare("INSERT INTO images (user_id, image) VALUES (?, ?)");
    $stmt->bind_param('is', $user_id, $image);
    $stmt->execute();
}
?>