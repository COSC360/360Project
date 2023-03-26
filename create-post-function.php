<?php
session_start();
include "connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['body'];
    $topicId = $_GET['id'];

    // Insert post into database
    $sql = "INSERT INTO posts (topic_id, title, body) VALUES ('$topicId', '$title', '$content')";

    if (mysqli_query($conn, $sql)) {
        header("Location: layout.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>