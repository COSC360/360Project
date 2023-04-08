<?php
session_start();
include "connection.php";

if (isset($_SESSION['u_id'])) {
   $userId = $_SESSION['u_id'];
   
   $sql = "SELECT * FROM topics WHERE topic_id IN (SELECT topic_id FROM my_topics WHERE u_id = $userId)";
   $result = $conn->query($sql);
   $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
   <meta charset="utf-8">
   <title>My Topics - PromptHub</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/layout.css" />
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
   <script>
      $(document).ready(function() {
         var $searchInput = $("#search-input");
         var $myTopicsList = $("#my-topics-list");

         $searchInput.on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $myTopicsList.find("li").filter(function() {
               $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
         });

         <?php if (isset($_SESSION['u_id'])): ?>
         <?php while ($row = $result->fetch_assoc()): ?>
            var $topicItem = $("<li class='list-group-item'></li>");
            var $topicLink = $("<a></a>").attr("href", "topic.php?id=<?php echo $row['topic_id']; ?>").text("<?php echo $row['topic_title']; ?>");
            $topicItem.append($topicLink);
            $myTopicsList.append($topicItem);
         <?php endwhile; ?>
         <?php endif; ?>
      });
   </script>
</head>
<body>
   <header id="masthead">
   <a href="index.php" class="linkbutton"><img src="images/PromptHublogo.png" alt="logo" height="70"></a>
      <div class="right">
      <?php if (isset($_SESSION['u_id'])): ?>
         <button class="btn btn-primary"><a href="profile.php" >My Profile</a></button>
         <button class="btn btn-primary"><a href="logout.php">Logout</a></button>
      <?php else: ?>
         <button class="btn btn-primary"><a href="login-signup.php">Login / Signup</a></button>
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
      <h1>My Topics</h1>
      <div class="entry">
         <input type="text" id="search-input" class="form-control mb-3" placeholder="Search Topics">
         <ul id="my-topics-list" class="list-group">
         </ul>
      </div>
      </article>
   </div>
   <footer>
      </div>
      <div class="footer-section">
         <a href="#" class="linkbutton">Contact Us</a>
         <a href="#" class="linkbutton">FAQ</a>
         <p>&copy; Copyright 2023 COSC 360 Prompt Hub Group
      </div>
   </footer>
</body>
</html>