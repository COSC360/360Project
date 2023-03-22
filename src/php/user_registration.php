<?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the username is valid
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        echo "Invalid username";
        exit;
    }

    // Check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address";
        exit;
    }

    // Check if the password is at least 8 characters long
    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long";
        exit;
    }

    // Upload the profile picture (if any)
    if (!empty($_FILES['profile_picture']['tmp_name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
    }

    // Save the user's information to the database
    // (you'll need to implement this part yourself)

    // Redirect the user to the homepage
    header("Location: index.php");
    exit;
}
?>