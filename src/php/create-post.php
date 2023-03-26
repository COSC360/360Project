<?php

// start session
session_start();

// check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // redirect to login page
    header("Location: login.php");
    exit();
}

// check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // get form data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    // validate form data
    if (empty($title) || empty($content)) {
        $error = "Please fill in all fields.";
    } else {

        // connect to database
        $conn = mysqli_connect('localhost', 'your_username', 'your_password', 'your_database');

        // check if connection was successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // insert post into database
        $sql = "INSERT INTO posts (title, content, user_id) VALUES ('$title', '$content', $user_id)";

        if (mysqli_query($conn, $sql)) {
            // redirect to forum page
            header("Location: forum.php");
            exit();
        } else {
            $error = "Error: " . mysqli_error($conn);
        }

        // close the database connection
        mysqli_close($conn);
    }
}

?>

<!-- HTML form to create a post -->
<form method="post">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title"><br>

    <label for="content">Content:</label>
    <textarea name="content" id="content"></textarea><br>

    <input type="submit" value="Submit">
</form>

<?php
// display error message if there is one
if (isset($error)) {
    echo $error;
}
?>