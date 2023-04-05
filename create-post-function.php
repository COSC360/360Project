<?php
session_start();
include "connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['body'];
    $topicId = $_GET['id'];
    $userId = $_SESSION['u_id'];

    $sql = "INSERT INTO posts (topic_id, u_id, title, body) VALUES ('$topicId', '$userId', '$title', '$content')";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>