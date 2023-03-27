<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head lang="en">
   <meta charset="utf-8">
   <title>Topics - PromptHub</title>
   <link rel="stylesheet" href="css/layout.css" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>
<body>
<header id="masthead">
   <h1>Prompt Hub</h1>
   <div class="right">
      <?php if (isset($_SESSION['u_id'])): ?>
         <a href="#" class="linkbutton">Notifications</a>
         <a href="profile.php" class="linkbutton">My Profile</a>
         <a href="logout.php" class="linkbutton">Logout</a>
      <?php else: ?>
         <a href="login-signup.php" class="linkbutton">Notifications</a>
         <a href="login-signup.php" class="linkbutton">My Profile</a>
      <?php endif; ?>
   </div>
</header>
<div id="main">
   <article id="right-sidebar">
      <div class="left">
         <a href="index.php" class="linkbutton"><img src="images/house.png" alt="house" height="70">Home</a>
      </div>
      <?php if (isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == 1): ?>
      <div class="left">
         <a href="admin.php" class="linkbutton"><img src="images/gear.png" alt="gear" height="70">Admin</a>
      </div>
      <?php endif; ?>
      <div class="left">
         <a href="topics.php" class="linkbutton"><img src="images/topics.png" alt="topics" height="70">Topics</a>
      </div>
      <div class="left">
      <a href="mytopics.php" class="linkbutton"><img src="images/star.png" alt="my topics" height="70">My Topics</a>
      </div>
   </article>
   <article id="center">
      <h2 id="topic-title">
      <?php
      include "connection.php";
      
      $topicId = $_GET['id'];

      $sql = "SELECT topic_title FROM topics WHERE topic_id = $topicId";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
         $row = $result->fetch_assoc();
         $topicName = $row['topic_title'];
      } else {
         $topicName = "Topic not found";
      }

      $conn->close();

      echo "Topic: " . $topicName;
      ?>
      </h2>
      <button id="subscribe-button" class="btn btn-primary mb-2">Subscribe</button>
      <a href="create-post.php?id=<?php echo $topicId; ?>" class="btn btn-secondary mb-2">Create Post</a>

      <?php
      include "connection.php";
      $topicId = $_GET['id'];
      $sql = "SELECT * FROM posts WHERE topic_id = $topicId ORDER BY post_id DESC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
               echo '<div class="card mb-3">';
               echo '<div class="card-body">';
               echo '<h5 class="card-title">' . $row['title'] . '</h5>';
               echo '<p class="card-text">' . $row['body'] . '</p>';
               echo '<p class="card-text"><small class="text-muted">By ' . $row['u_id'] . ' on ' . $row['creation_time'] . '</small></p>';
               echo '<a href="post.php?id=' . $row['post_id'] . '&topic_id=' . $row['topic_id'] . '" class="btn btn-primary">Read More</a>';
               echo '</div></div>';
         }
      } else {
         echo '<p>No posts found.</p>';
      }
      $conn->close();
      ?>
   </article>
</div>
<footer>
   <div class="footer-section">
      <a href="#" class="linkbutton">Contact Us</a>
      <a href="#" class="linkbutton">FAQ</a>
      <p>&copy; Copyright 2023 COSC 360 Prompt Hub Group
   </div>
</footer>
</body>
</html>
