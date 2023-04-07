<?php   
// $DATABASE_HOST = 'localhost';
// $DATABASE_USER = '41797044';
// $DATABASE_PASS = '41797044';
// $DATABASE_NAME = 'db_41797044';

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'prompthub';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


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
            $output .= '</div>';
            $output .= '</div>';
        }
    } else {
        $output = "<p>No recent posts found.</p>";
    }

    return $output;
}
?>