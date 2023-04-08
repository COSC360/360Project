<?php   
$DATABASE_HOST = 'localhost';
$DATABASE_USER = '41797044';
$DATABASE_PASS = '41797044';
$DATABASE_NAME = 'db_41797044';

// $DATABASE_HOST = 'localhost';
// $DATABASE_USER = 'root';
// $DATABASE_PASS = '';
// $DATABASE_NAME = 'prompthub';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


?>