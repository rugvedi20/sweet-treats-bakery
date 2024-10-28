<?php
$host = 'localhost';
$user = 'root';
$password = ''; // Add your MySQL password here
$database = 'bakery_db'; // Your database name

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
