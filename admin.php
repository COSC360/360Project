<?php
session_start();
if (!isset($_SESSION['u_id']) || !isset($_SESSION['admin_status']) || $_SESSION['admin_status'] == 0) {
   header("Location: index.php");
   exit;
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
   <meta charset="utf-8">
   <title>PromptHub Admin Portal</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/layout.css" />
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>
<body>
   <header id="masthead">
   <a href="index.php" class="linkbutton"><img src="images/PromptHub.png" alt="logo" height="70"></a>
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
         <h1>Admin Hub</h1>
         <div class="entry">
            <?php
            include "connection.php";
            $stmt = $conn->prepare("SELECT post_id, title, body, creation_time FROM posts ORDER BY creation_time DESC");
            $stmt->execute();
            $stmt->bind_result($post_id, $post_title, $post_content, $created_at);

            echo "<h1>Admin: Manage Posts</h1>";
            echo "<table>";
            echo "<tr><th>Title</th><th>Content</th><th>Created at</th><th>Delete</th></tr>";

            while ($stmt->fetch()) {
               echo "<tr>";
               echo "<td>" . htmlspecialchars($post_title) . "</td>";
               echo "<td>" . htmlspecialchars($post_content) . "</td>";
               echo "<td>" . htmlspecialchars($created_at) . "</td>";
               echo "<td><a href='delete_post.php?post_id=" . $post_id . "'>Delete</a></td>";
               echo "</tr>";
            }
            echo "</table>";
            $stmt->close();
            $conn->close();
            ?>
         </div>
         <div class="entry">
            <?php
            include "connection.php";
            $stmt = $conn->prepare("SELECT u_id, username, email, admin_status FROM users");
            $stmt->execute();
            $stmt->bind_result($u_id, $username, $email, $admin_status);

            echo "<h1>Admin: Manage Users</h1>";
            echo "<table>";
            echo "<tr><th>Username</th><th>Email</th><th>Admin Status</th><th>Delete</th><th>Promote/Demote</th></tr>";

            while ($stmt->fetch()) {
               echo "<tr>";
               echo "<td>" . htmlspecialchars($username) . "</td>";
               echo "<td>" . htmlspecialchars($email) . "</td>";
               echo "<td>" . ($admin_status == 1 ? "Admin" : "User") . "</td>";
               echo "<td><a href='delete_user.php?u_id=" . $u_id . "'>Delete</a></td>";
               echo "<td><a href='toggle_admin.php?u_id=" . $u_id . "'>" . ($admin_status == 1 ? "Demote" : "Promote") . "</a></td>";
               echo "</tr>";
            }

            echo "</table>";
            $stmt->close();
            $conn->close();
            ?>
         </div>
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