<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Post - COSC 360 Project</title>
    <link rel="stylesheet" href="css/layout.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>
<body>
<header id="masthead" class="bg-primary text-white py-3">
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
    <main id="center" class="col-md-9">
    <?php
    
    include "connection.php";
    $postId = $_GET['id'];
    $topicId = $_GET['topic_id'];
    
    // Get the post details and the username of the user who created it
    $sql = "SELECT posts.*, users.username FROM posts JOIN users ON posts.u_id = users.u_id WHERE post_id = $postId AND topic_id = $topicId";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<div class="card mb-3">';
        echo '<div class="card-header">';
        echo '<span class="badge bg-secondary ms-2">Topic: <a href="topic.php?id=' . $row['topic_id'] . '">' . $row['title'] . '</a></span>';
        echo '</div>';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['title'] . '</h5>';
        echo '<p class="card-text">' . $row['body'] . '</p>';
        echo '<p class="card-text"><small class="text-muted">By ' . $row['username'] . ' on ' . $row['creation_time'] . '</small></p>';
        echo '</div></div>';
    } else {
        echo '<p>Post not found.</p>';
    }
    // Get the comments and the username of the users who created them
    $sql = "SELECT comments.*, users.username FROM comments JOIN users ON comments.u_id = users.u_id WHERE post_id = $postId";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="card mb-3">';
            echo '<div class="card-body">';
            echo '<p class="card-text">' . $row['body'] . '</p>';
            echo '<p class="card-text"><small class="text-muted">By ' . $row['username'] . ' on ' . $row['creation_time'] . '</small></p>';
            echo '</div></div>';
        }
    }
    $conn->close();
    ?>
    <form id="comment-form" method="post" action="create-comment.php">
        <input type="hidden" name="id" value="<?php echo $postId; ?>">
        <input type="hidden" name="topic_id" value="<?php echo $topicId; ?>">
   <?php if (isset($_SESSION['u_id'])): ?>
    
        <div class="mb-3">
            <label for="comment" class="form-label">Leave a comment:</label>
            <textarea class="form-control" id="comment" name="body" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" form="comment-form">Submit</button>
   <?php else: ?>
    <p>Please <a href="login-signup.php">log in</a> to comment.</p>
   <?php endif; ?>
    </form>
    </main>
    </div>
    <footer class="bg-primary text-white text-center py-3">
        <div class="footer-section">
            <a href="#" class="linkbutton">Contact Us</a>
            <a href="#" class="linkbutton">FAQ</a>
            <p>&copy; <?php echo date('Y'); ?> COSC 360 Prompt Hub Group</p>
        </div>
    </footer>
    </body>
    </html>