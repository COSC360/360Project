<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['admin_status']) || $_SESSION['admin_status'] != 1) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    $stmt = $conn->prepare("DELETE FROM posts WHERE post_id = ?");
    $stmt->bind_param("i", $post_id);

    if ($stmt->execute()) {
        header("Location: admin.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    header("Location: admin.php");
}

$conn->close();
?>