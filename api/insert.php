<?php
// Include MongoDB PHP library
require 'vendor/autoload.php';


// Set up MongoDB connection
$client = new MongoDB\Client('mongodb+srv://Payroll:Payroll2023@payroll.hzvfjqq.mongodb.net/payroll_app');
$database = $client->selectDatabase('payroll_app');
$collection = $database->selectCollection('people');

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST["username"];
	$password = $_POST["password"];
    $fullname = $_POST["fullname"];
	$age = $_POST["age"];
	$address = $_POST["address"];
    $cnumber = $_POST["cnumber"];
	$email = $_POST["email"];

    // Check if username already exists
    $existingUser = $collection->findOne(['username' => $username]);
    if ($existingUser) {
        echo "Username already exists.";
    } else {
        // Insert new user into MongoDB
        $newUser = [
            'username' => $username,
			'password' => $password,
            'fullname' => $fullname,
			'age' => $age,
			'address' => $address,
            'cnumber' => $cnumber,
			'email' => $email,
            

        ];
        $collection->insertOne($newUser);
        echo "Registration successful!";
    }
}



?>
<div id="center_button"><button onclick="location.href='../index.html'">Back to Home</button></div>
