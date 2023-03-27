<?php
include "connection.php";
$query = "SELECT * FROM topics";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    $query = "INSERT INTO topics (topic_title) VALUES ('Test Topic')";
    if (mysqli_query($conn, $query)) {
        echo "Topic added successfully.";
    } else {
        echo "Error adding topic: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<li class="list-group-item">';
        echo "<a href='topic.php?id={$row['topic_id']}'>{$row['topic_title']}</a>";
        echo '</li>';
    }
}

mysqli_close($conn);
?>