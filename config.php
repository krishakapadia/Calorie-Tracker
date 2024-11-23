<?php
$host = 'localhost'; 
$username = 'root'; 
$password = ''; 
$database = 'calorie_tracker';

$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
