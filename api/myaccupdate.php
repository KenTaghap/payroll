<?php
// Include the MongoDB PHP driver
require 'vendor/autoload.php';

error_reporting(E_ERROR | E_PARSE);

use MongoDB\Client;

$connectionString = "mongodb+srv://Payroll:Payroll2023@payroll.hzvfjqq.mongodb.net/payroll_app";
try {
    // Create a MongoDB client instance
    $client = new Client($connectionString);

    // Select the database and collection
    $database = $client->payroll_app; // Replace with your database name
    $collection = $database->people; // Replace with your collection name

    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get user input from the form
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $cnumber = $_POST['cnumber'];
    $email = $_POST['email'];
    


        // Define the filter to identify the document to update based on the username
        $filter = ['username' => $username];

        // Define the update operation based on the user input
        $update = [
            '$set' => [
                'fullname' => $fullname,
                'address' => $address,
                'password' => $password,
                'age' => $age,
                'cnumber' => $cnumber,
                'email' => $email,
                'birthday' => $birthday,
            ],
        ];

        // Update data in the collection
        $result = $collection->updateOne($filter, $update);

        if ($result->getModifiedCount() > 0) {


            echo "Document updated successfully.";
        echo '<br>';
        echo '<a href="myacc.php">Go Back</a>';
        
            
            
        } else {

            echo "Document not updated.";
        echo '<br>';
        echo '<a href="myacc.php">Go Back</a>';
        }
    } else {
        echo "Please submit the form to update user information.";
        echo '<br>';
        echo '<a href="myacc.php">Go Back</a>';
        
    }
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
?>
