<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['admin_status']) || $_SESSION['admin_status'] != 1) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['u_id'])) {
    $u_id = $_GET['u_id'];

    $stmt = $conn->prepare("UPDATE users SET admin_status = NOT admin_status WHERE u_id = ?");
    $stmt->bind_param("i", $u_id);

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