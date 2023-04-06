<?php
include "connection.php";

if (isset($_POST['keyword'])) {
  $keyword = $_POST['keyword'];

  $sql = "SELECT posts.*, users.username FROM posts JOIN users ON posts.u_id = users.u_id WHERE title LIKE '%$keyword%'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '<div class="card mb-3">';
      echo '<div class="card-body">';
      echo '<h5 class="card-title">' . $row['title'] . '</h5>';
      echo '<p class="card-text">' . $row['body'] . '</p>';
      echo '<p class="card-text"><small class="text-muted">By ' . $row['username'] . ' on ' . $row['creation_time'] . '</small></p>';
      echo '<a href="post.php?id=' . $row['post_id'] . '&topic_id=' . $row['topic_id'] . '" class="btn btn-primary">Read More</a>';
      echo '</div></div>';
    }
  } else {
    echo '<p>No posts found.</p>';
  }
}

$conn->close();
?>
