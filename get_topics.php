<?php
include "connection.php";

$result = $conn->query("SELECT topic_title FROM topics ORDER BY topic_title");

$topics = array();
while ($row = $result->fetch_assoc()) {
    $topics[] = $row['topic_title'];
}

header('Content-Type: application/json');
echo json_encode($topics);

$conn->close();
?>