<?php
session_start();
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_REQUEST['title'];
    $content = $_REQUEST['content'];
    $topic = $_REQUEST['topic'];
    $author = $_SESSION['username'];

    $stmt = $conn->prepare("INSERT INTO posts (title, content, topic, author) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $content, $topic, $author);

    if ($stmt->execute()) {
        header("Location: topic.html?topic=" . urlencode($topic));
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>