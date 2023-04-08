<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head lang="en">
   <meta charset="utf-8">
   <title>COSC 360 Project</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/layout.css" />
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
   <script>
      $(document).ready(function() {
         $("#search-button").click(function() {
            var keyword = $("#search-input").val();
            $.ajax({
               url: "search-posts.php",
               method: "POST",
               data: { keyword: keyword },
               success: function(data) {
                  $("#posts-container").html(data);
               }
            });
         });
      });
   </script>

</head>
<body>
<header id="masthead" >
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
    <main id="center" class="col-md-9">
         <h1>Recent Posts</h1>
         <div class="input-group mb-4">
            <input type="text" id="search-input" class="form-control" placeholder="Search posts by title...">
            <button class="btn btn-primary" id="search-button">Search</button>
         </div>
         <div id="posts-container">
            <?php include 'trending.php'; echo fetch_recent_posts($conn); ?>
         </div>
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
