<?php
// Database credentials
$hostname = 'localhost';  
$username = 'root';       
$password = '';   
$database = 'login';      

// Create a connection
$con = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>