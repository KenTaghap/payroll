<?php
// Include MongoDB PHP library
require 'vendor/autoload.php';

error_reporting(E_ERROR | E_PARSE);


// Set up MongoDB connection
$client = new MongoDB\Client('mongodb+srv://glycerasiado17:glycerasiado17@cluster0.s9v6t.mongodb.net/admin_login');
$database = $client->selectDatabase('admin_login');
$collection = $database->selectCollection('users');

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$id = $_POST["id"];
    $name = $_POST["name"];
	$section = $_POST["section"];
    $number = $_POST["number"];
	 $username = $_POST["username"];
	$password = $_POST["password"];

    // Check if username already exists
    $existingUser = $collection->findOne(['username' => $username]);
    if ($existingUser) {
        echo "Username already exists.";
    } else {
        // Insert new user into MongoDB
        $newUser = [
		'id' => $id,
            'name' => $name,
	'section' => $section,
            'contact' => $number,
	'username' => $username,
		'password' => $password,		
            

        ];
        $collection->insertOne($newUser);
        echo "Registration successful!";
    }
}



?>
<div id="center_button"><button onclick="location.href='../index.html'">Back to Home</button></div>
