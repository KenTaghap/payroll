<?php
require 'vendor/autoload.php';

error_reporting(E_ERROR | E_PARSE);

use MongoDB\Client as MongoClient;

// Connect to MongoDB Atlas
try {
    $mongoClient = new MongoClient("mongodb+srv://glycerasiado17:glycerasiado17@cluster0.s9v6t.mongodb.net/admin_login");
    $database = $mongoClient->admin_login;
    $collection = $database->users;
} catch (Exception $e) {
    die("Error connecting to MongoDB: " . $e->getMessage());
}

$errorMsg = ""; // Initialize an error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query for the user
    $query = ["username" => $username, "password" => $password];
    $user = $collection->findOne($query);

    if ($user) {
        // Redirect or indicate successful login
        header("Location: ../home/index.html");
        exit();
    } else {
        $errorMsg = "Invalid username or password.";
    }
}
?>
