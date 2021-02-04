<?php
 session_start();

//constant variables
define('SITEURL', 'http://localhost/food-order/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order');
//Connecting to database
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
//selecting database
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
?>
