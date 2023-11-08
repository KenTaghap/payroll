<?php
require 'vendor/autoload.php';

// Connect to MongoDB Atlas
$mongoClient = new MongoDB\Client("mongodb+srv://Payroll:Payroll2023@payroll.hzvfjqq.mongodb.net/payroll_app");

// Select the database and collection
$database = $mongoClient->payroll_app;
$collection = $database->people;

$errorMsg = ""; // Initialize an error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query for the user
    $query = ["username" => $username, "password" => $password];
    $user = $collection->findOne($query);

    if ($user) {
        // Successful login, set session variables or redirect to a protected area
        header("Location: ../home/index.html");
        
    } else {
        // Invalid login, display an error message
        echo "Invalid username or password";
        echo '<br>';
        echo '<a href="../index.html">Go Back</a>';
        
    }
}
?>
