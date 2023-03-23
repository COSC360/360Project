<?php
session_start();
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_REQUEST['username'];
    $passw = $_REQUEST['passw'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($passw, $user['passw'])) {
        $_SESSION["username"] = $user["username"];
        header("Location: layout.html");
    } else {
        echo "Error: Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
?>