<?php
session_start();
include "connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['body'];

    // Insert post into database
    $sql = "INSERT INTO posts (title, body) VALUES ('$title', '$content')";

    if (mysqli_query($conn, $sql)) {
        echo "New post created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>