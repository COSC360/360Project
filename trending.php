<?php
include "connection.php";

function fetch_recent_posts($conn) {
    $query = "SELECT * FROM posts ORDER BY creation_time DESC";
    $result = $conn->query($query);

    $output = "";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= '<div class="card mb-3">';
            $output .= '<div class="card-body">';
            $output .= '<h5 class="card-title">' . $row['title'] . '</h5>';
            $output .= '<p class="card-text">' . $row['body'] . '</p>';
            $output .= '<p class="card-text"><small class="text-muted">Posted on ' . $row['creation_time'] . '</small></p>';
            $output .= '<a href="post.php?id=' . $row['post_id'] . '&topic_id=' . $row['topic_id'] . '" class="btn btn-primary">Read More</a>';
            $output .= '</div>';
            $output .= '</div>';
        }
    } else {
        $output = "<p>No recent posts found.</p>";
    }

    return $output;
}
?>