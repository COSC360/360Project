<?php
session_start();
include "connection.php";

if (isset($_SESSION['u_id'])) {
   if (isset($_POST['topic_id'])) {
      $topicId = $_POST['topic_id'];
      $userId = $_SESSION['u_id'];
      
      $checkSql = "SELECT * FROM my_topics WHERE topic_id = $topicId AND u_id = $userId";
      $checkResult = $conn->query($checkSql);
      if ($checkResult->num_rows > 0) {
         echo "You are already subscribed!";
      } else {
         $sql = "INSERT INTO my_topics (topic_id, u_id) VALUES ($topicId, $userId)";
         $conn->query($sql);
         $conn->close();
         echo "Subscribed!";
      }
   }
}
?>
