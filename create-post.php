<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Create Post - COSC 360 Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/layout.css" />
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
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
   </div>

<main id="center" class="col-md-9">
   <?php if (isset($_SESSION['u_id'])): ?>
      <h2>Create Post</h2>
      <form id="create-post-form" method="post" action="create-post-function.php?id=<?php echo $_GET['id']; ?>">
         <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
         <div class="mb-3">
               <label for="title" class="form-label">Title</label>
               <input type="text" class="form-control" id="title" name="title" required>
         </div>
         <div class="mb-3">
               <label for="content" class="form-label">Content</label>
               <textarea class="form-control" id="content" name="body" rows="6" required></textarea>
         </div>
         <button type="submit" class="btn btn-primary">Submit</button>
      </form>
   <?php else: ?>
      <p>Please <a href="login-signup.php">log in</a> to create a post.</p>
   <?php endif; ?>
</main>
</body>
</html>
