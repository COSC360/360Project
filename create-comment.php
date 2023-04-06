<?php
session_start();
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $body = $_POST['body'];
    $postId = $_POST['id'];
    $topicId = $_POST['topic_id'];
    $userId = $_SESSION['u_id'];
    
    $sql = "INSERT INTO comments (post_id, u_id, body) VALUES ($postId, $userId, '$body')";
    if (mysqli_query($conn, $sql)) {
        header("Location: post.php?id=$postId&topic_id=$topicId");
        exit();
    } else {
        echo $sql . "<br>" . mysqli_error($conn);
    }
}
$conn->close();
?>