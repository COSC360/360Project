<?php
session_start();
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $body = $_POST['body'];
    $postId = $_POST['id'];
    $topicId = $_POST['topic_id'];
    // $userId = $_SESSION['u_id'];
    
    // Insert comment into database
    $sql = "INSERT INTO comments (post_id, body) VALUES ($postId, '$body')";
    if (mysqli_query($conn, $sql)) {
        // Redirect back to the post page
        header("Location: post.php?id=$postId&topic_id=$topicId");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

$conn->close();
?>