<?php
require 'vendor/autoload.php';

use MongoDB\Client as MongoClient;

// Enable error reporting for production
error_reporting(E_ERROR | E_PARSE);

$errorMsg = "";

// Check if POST request is made
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to MongoDB
    try {
        $mongoClient = new MongoClient("mongodb+srv://glycerasiado17:glycerasiado17@cluster0.s9v6t.mongodb.net/admin_login");
        $database = $mongoClient->admin_login;
        $collection = $database->users;
    } catch (Exception $e) {
        die("Error connecting to MongoDB: " . $e->getMessage());
    }

    // Get username and password from POST data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query for the user in MongoDB
    $query = ["username" => $username, "password" => $password];
    $user = $collection->findOne($query);

    if ($user) {
        // Redirect to the dashboard on successful login
        header("Location: ../home/index.html");
        exit();
    } else {
        // Redirect back to the HTML page with an error message
        header("Location: ../index.html?error=Invalid+username+or+password");
        exit();
    }
}
?>
