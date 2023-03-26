<?php
session_start();
include "connection.php";
// Get the topic ID from the URL
$topicId = $_GET['id'];


// Get the topic name from the database
$sql = "SELECT topic_name FROM topics WHERE topic_id = $topicId";
$result = $conn->query($sql);

// Check if topic exists
if ($result->num_rows > 0) {
  // Output topic name as JSON
  $row = $result->fetch_assoc();
  $topicName = $row['topic_name'];
  echo json_encode(array("topic_name" => $topicName));
} else {
  // Output error as JSON
  echo json_encode(array("error" => "Topic not found"));
}

$conn->close();
?>