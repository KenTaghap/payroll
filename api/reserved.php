<?php
// Include MongoDB PHP library
require 'vendor/autoload.php';

error_reporting(E_ERROR | E_PARSE);


// Set up MongoDB connection
$client = new MongoDB\Client('mongodb+srv://glycerasiado17:glycerasiado17@cluster0.s9v6t.mongodb.net/admin_login');
$database = $client->selectDatabase('admin_login');
$collection = $database->selectCollection('reserved');

$errorMsg = ""; // Initialize an error message variable

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$id = $_POST["id"];
    $name = $_POST["name"];
	$section = $_POST["section"];
    $book = $_POST["book"];


    
        // Insert new user into MongoDB
        $newUser = [
		'id' => $id,
            'name' => $name,
	'section' => $section,
            'book' => $book,
		
            

        ];
        $user = $collection->insertOne($newUser);
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 d-flex align-items-center justify-content-center">
        <div class="card text-center p-4 shadow" style="max-width: 400px; width: 100%;">

            <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                <?php if ($user): ?>
                    <!-- Success message -->
                    <div class="alert alert-success">Successful!</div>
                    <a href="../home/index.html" class="btn btn-primary mt-3">Go to Home</a>
                <?php else: ?>
                    <!-- Error message -->
                    <div class="alert alert-danger">Failed!</div>
                    <a href="../home/index.html" class="btn btn-secondary mt-3">Go Back</a>
                <?php endif; ?>
            <?php endif; ?>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




