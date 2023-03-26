<?php

// database credentials
$host = 'localhost'; // replace with your database host
$username = 'your_username'; // replace with your database username
$password = 'your_password'; // replace with your database password
$database = 'your_database'; // replace with your database name

// create a database connection
$conn = mysqli_connect($host, $username, $password, $database);

// check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// connection successful
echo "Connected successfully to database.";

// close the database connection
mysqli_close($conn);

?>