<?php
$servername = "mysql.hostinger.com";
$username = "u283556798_MDMain";
$password = "MDbmc.it@123";
$dbname = "u283556798_MDEcom";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
