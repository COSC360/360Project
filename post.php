<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Post - COSC 360 Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/layout.css" />
</head>
<body>
<header id="masthead" class="bg-primary text-white py-3">
    <h1>Prompt Hub</h1>
    <div class="right">
       <a href="#" class="linkbutton">Notifications</a>
       <a href="profile.html" class="linkbutton">My Profile</a>
    </div>
    
    </header>
    <div id="main">
    <article id="right-sidebar">
       <div class="left">
          <a href="layout.html" class="linkbutton"><img src="images/house.png" alt="house" height="70">Home</a>
       </div>
       <div class="left">
          <a href="admin.html" class="linkbutton"><img src="images/gear.png" alt="gear" height="70">Admin</a>
       </div>
       <div class="left">
          <a href="topics.html" class="linkbutton"><img src="images/topics.png" alt="topics" height="70">Topics</a>
       </div>
       <div class="left">
       <a href="mytopics.html" class="linkbutton"><img src="images/star.png" alt="my topics" height="70">My Topics</a>
       </div>
    </p>
    </article>
        <main id="center" class="col-md-9">
        <?php
    session_start();
    include "connection.php";
    // Get the post ID and topic ID from the URL
    $postId = $_GET['id'];
    $topicId = $_GET['topic_id'];

    // Fetch post data from server
    $sql = "SELECT * FROM posts WHERE post_id = $postId AND topic_id = $topicId";
    $result = $conn->query($sql);

    // Check if post exists
    if ($result->num_rows > 0) {
        // Output post content
        $row = $result->fetch_assoc();
        echo '<div class="card mb-3">';
        echo '<div class="card-header">';
        echo '<span class="badge bg-secondary ms-2">Topic: <a href="topic.php?id=' . $row['topic_id'] . '">' . $row['title'] . '</a></span>';
        echo '</div>';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['title'] . '</h5>';
        echo '<p class="card-text">' . $row['body'] . '</p>';
        echo '<p class="card-text"><small class="text-muted">By ' . $row['u_id'] . ' on ' . $row['creation_time'] . '</small></p>';
        echo '</div></div>';
    } else {
        // Output error message
        echo '<p>Post not found.</p>';
    }
    $sql = "SELECT * FROM comments WHERE post_id = $postId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card mb-3">';
        echo '<div class="card-body">';
        echo '<p class="card-text">' . $row['body'] . '</p>';
        echo '<p class="card-text"><small class="text-muted">By ' . $row['u_id'] . ' on ' . $row['creation_time'] . '</small></p>';
        echo '</div></div>';
    }
}
    $conn->close();
?>
        <form id="comment-form" method="post" action="create-comment.php">
    <input type="hidden" name="id" value="<?php echo $postId; ?>">
    <input type="hidden" name="topic_id" value="<?php echo $topicId; ?>">
    <div class="mb-3">
        <label for="comment" class="form-label">Leave a comment:</label>
        <textarea class="form-control" id="comment" name="body" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary" form="comment-form">Submit</button>
</form>
        </main>
    </div>
</div>
<footer class="bg-primary text-white text-center py-3">
    <div class="footer-section">
        <a href="#" class="linkbutton">Contact Us</a>
        <a href="#" class="linkbutton">FAQ</a>
        <p>&copy; Copyright 2023 COSC 360 Prompt Hub Group</p>
    </div>
</footer>
</body>
</html>
