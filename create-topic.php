<?php
session_start();
include 'connection.php';


if (isset($_POST['topic_title']) && !empty($_POST['topic_title'])) {
    $title = $_POST['topic_title'];

    $sql = "INSERT INTO topics (topic_title) VALUES ('$title')";

    if (mysqli_query($conn, $sql)) {
        header("Location: topics.php");
        exit();
    } else {
        echo $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Topic title is required";
}
?>