<?php
//signup
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_REQUEST['username'];
    $email = $_REQUEST['email'];
    $passw =  $_REQUEST['passw'];

    $hashed_password = password_hash($passw, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, passw) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $passw);
    
    if ($stmt->execute()) {
        $_SESSION["username"] = $username;
        header("Location: index.html");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


