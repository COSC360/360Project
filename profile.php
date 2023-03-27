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
  <h1>My Profile</h1>
  <div class="profile-header">
    <img src="<?php echo $user_data['profile_pic']; ?>" alt="Profile Picture" class="profile-picture">
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
            <p><?php echo $post['content']; ?></p>
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
        <form id="edit-user-form">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $user_data['username']; ?>" required>
          </div>
          <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
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
