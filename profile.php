<?php
session_start();

include 'connection.php';

if (isset($_SESSION['u_id'])) {
    $user_id = $_SESSION['u_id'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE u_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $user_data = $stmt->get_result()->fetch_assoc();

    $stmt = $conn->prepare("SELECT * FROM posts WHERE u_id = ? ORDER BY creation_time DESC LIMIT 5");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $recent_posts = $stmt->get_result();

    $stmt = $conn->prepare("SELECT u.*, i.images, i.contentType FROM users u LEFT JOIN user_images i ON u.u_id = i.u_id WHERE u.u_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $user_data = $stmt->get_result()->fetch_assoc();
    }
?>

<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8">
  <title>My Profile</title>
  <link rel="stylesheet" href="css/layout.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
  <h1>My Profile</h1>
  <div class="profile-header">
  <img src="data:<?php echo $user_data['contentType']; ?>;base64,<?php echo base64_encode($user_data['images']); ?>" alt="Profile Picture" class="profile-picture">

    <div>
      <h2 class="username"><?php echo $user_data['username']; ?></h2>
      <p class="bio"><?php echo $user_data['profile_bio']; ?></p>
    </div>
    <button id="edit-user-button" class="btn btn-primary" data-toggle="modal" data-target="#edit-user-modal">Edit User</button>
  </div>
  <h2>Recent Posts</h2>
  <div id="recent-posts">
    <?php while ($post = $recent_posts->fetch_assoc()): ?>
        <div class="post">
            <h3><?php echo $post['title']; ?></h3>
            <p><?php echo $post['body']; ?></p>
    </div>
    <?php endwhile; ?>
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
<div class="modal" tabindex="-1" role="dialog" id="edit-user-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-user-form" action="upload-image.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $user_data['username']; ?>" required>
          </div>
          <div class="form-group">
            <label for="user_images">Profile Picture</label>
            <input type="file" class="form-control" id="user_images" name="user_images">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_data['email']; ?>" required>
          </div>
          <div class="form-group">
            <label for="bio">Bio</label>
            <textarea class="form-control" id="profile_bio" name="bio" rows="3"><?php echo $user_data['profile_bio']; ?></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="save-changes-button">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  document.getElementById('save-changes-button').addEventListener('click', function (e) {
    e.preventDefault();

    const formData = new FormData(document.getElementById('edit-user-form'));
    fetch('update_user.php', {
      method: 'POST',
      body: formData,
    })
      .then((response) => {
        return response.text().then((text) => {
          console.log("Raw server response:", text);
          return JSON.parse(text);
        });
      })
      .then((data) => {
        if (data.success) {
          document.querySelector('.username').textContent = formData.get('username');
          document.querySelector('.bio').textContent = formData.get('bio');

          $('#edit-user-modal').modal('hide');

          location.reload();
        } else {
          alert('Error updating user data');
        }
      })
      .catch((error) => {
        console.error('Error:', error);
      });
  });
</script>
</body>
</html>
