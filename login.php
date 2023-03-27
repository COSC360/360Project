<?php
include "connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $passw = $_POST['passw'];

    $stmt = $conn->prepare("SELECT u_id, username, passw, admin_status FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($u_id, $username, $hashed_password, $admin_status);
        $stmt->fetch();
        
        if (password_verify($passw, $hashed_password)) {
            $_SESSION['u_id'] = $u_id;
            $_SESSION['username'] = $username;
            $_SESSION['admin_status'] = $admin_status;
            header("Location: index.php");
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
    $con->close();
}
?>
