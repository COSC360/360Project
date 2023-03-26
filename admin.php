<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head lang="en">
   <meta charset="utf-8">
   <title>PromptHub Admin Portal</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/layout.css" />
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
   <div class="left">
      <a href="admin.php" class="linkbutton"><img src="images/gear.png" alt="gear" height="70">Admin</a>
   </div>
   <div class="left">
      <a href="topics.php" class="linkbutton"><img src="images/topics.png" alt="topics" height="70">Topics</a>
   </div>
   <div class="left">
   <a href="mytopics.php" class="linkbutton"><img src="images/star.png" alt="my topics" height="70">My Topics</a>
   </div>
</p>
</article>
<article id="center">
<h1>Admin Hub</h1>
<div class="entry">
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