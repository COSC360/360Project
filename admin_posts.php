<?php
session_start();
include 'connection.php';

// Check if the user is an admin
if (!isset($_SESSION['admin_status']) || $_SESSION['admin_status'] != 1) {
    header("Location: index.php");
    exit;
}

// Fetch all posts from the database, sorted by most recently added
$stmt = $conn->prepare("SELECT post_id, post_title, post_content, created_at FROM posts ORDER BY created_at DESC");
$stmt->execute();
$stmt->bind_result($post_id, $post_title, $post_content, $created_at);

// Display the posts along with a delete option
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
