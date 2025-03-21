<?php
$host = "localhost";  // Change if needed
$dbname = "u283556798_MDEcom";
$username = "u283556798_MDMain";
$password = "MDbmc.it@123";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
