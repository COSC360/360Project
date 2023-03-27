<?php
session_start();
include "connection.php";

$topicId = $_GET['id'];

$sql = "SELECT topic_name FROM topics WHERE topic_id = $topicId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $topicName = $row['topic_name'];
    echo json_encode(array("topic_name" => $topicName));
} else {
    echo json_encode(array("error" => "Topic not found"));
}

$conn->close();
?>