<?php
//signup
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_REQUEST['username'];
    $email = $_REQUEST['email'];
    $passw =  $_REQUEST['passw'];

    $hashed_password = password_hash($passw, PASSWORD_BCRYPT);
    $default_profile_pic = './uploads/profile_pics/profile-picture-placeholder.png';

    $stmt = $conn->prepare("INSERT INTO users (username, email, passw, profile_pic) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $hashed_password, $default_profile_pic);
    
    if ($stmt->execute()) {
        $_SESSION["username"] = $username;
        header("Location: index.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


