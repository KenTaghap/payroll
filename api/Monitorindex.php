<?php
require 'vendor/autoload.php';
error_reporting(E_ERROR | E_PARSE);

// MongoDB connection configuration
$mongoURI = "mongodb+srv://glycerasiado17:glycerasiado17@cluster0.s9v6t.mongodb.net/admin_login";
$dbName = "admin_login";
$collectionName = "borrowed";

// Create a MongoDB client
$mongoClient = new MongoDB\Client($mongoURI);

// Select database and collection
$database = $mongoClient->$dbName;
$collection = $database->$collectionName;

// Check if a search term (studentid) is provided
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Find documents based on the search term (studentid)
$filter = [];
if (!empty($searchTerm)) {
    $filter = ['studentid' => $searchTerm];
}

// Find documents matching the filter
$cursor = $collection->find($filter);

// Fetch data and store in an array for HTML rendering
$productData = [];
foreach ($cursor as $document) {
    $productData[] = [
        'studentid' => $document->studentid,
        'bookid' => $document->bookid,
        'booktitle' => $document->booktitle,
        'student' => $document->student,
        'exp' => $document->exp,
        'borrowed' => $document->borrowed,
    ];
}
?>





<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Farmers Monitor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        /* Your existing CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-image: url('../home/Monitor/images/1.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            padding: 20px;
            color: white;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
        }

        h1, h4 {
            text-align: center;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            margin-right: 10px;
        }

        input[type="text"] {
            padding: 5px;
            border-radius: 5px;
            border: none;
            width: 100%;
            max-width: 300px;
        }

        input[type="submit"] {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        ul.product-list {
            list-style-type: none;
            padding: 0;
        }

        li.product-item {
            border: 2px solid white;
            margin-bottom: 20px;
            padding: 10px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
        }

        .product-image {
            max-width: 100px;
            margin-right: 20px;
            margin-bottom: 10px;
        }

        .product-details {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .product-details span {
            font-weight: bold;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: block;
            margin: 20px auto;
            background-color: #4CAF50;
            color: white;
        }

        button a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Product List</h1>
        
        <!-- Search form -->
        <form action="" method="GET">
            <label for="search">Student ID:</label>
            <input type="text" id="studentid" name="studentid" placeholder="Student ID" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <input type="submit" value="Display">

            <script>
        // Retrieve the student ID from localStorage and display it in the input field
        document.getElementById("studentid").value = localStorage.getItem("studentId") || "Not Available";
    </script>

        </form>
        
        <ul class="product-list">
           <?php foreach ($productData as $product) : ?>
                <li class="product-item">
                    <div class="product-details">
                        <span>Student-ID:</span>
                        &nbsp;&nbsp;
                        <span class="product-info"><?php echo $product['studentid']; ?></span>
                    </div>
                    <div class="product-details">
                        <span>Book-id:</span>
                        &nbsp;&nbsp;
                        <span class="product-info"><?php echo $product['bookid']; ?></span>
                    </div>
                    <div class="product-details">
                        <span>Book Title:</span>
                        &nbsp;&nbsp;
                        <span class="product-info"><?php echo $product['booktitle']; ?></span>
                    </div>
                    <div class="product-details">
                        <span>Student Name:</span>
                        &nbsp;&nbsp;
                        <span class="product-info"><?php echo $product['student']; ?></span>
                    </div>
                    <div class="product-details">
                        <span>Expiry:</span>
                        &nbsp;&nbsp;
                        <span class="product-info"><?php echo $product['exp']; ?></span>
                    </div>
                    <div class="product-details">
                        <span>borrowed:</span>
                        &nbsp;&nbsp;
                        <span class="product-info"><?php echo $product['borrowed']; ?></span>
                    </div>
                </li>
    <?php endforeach; ?>
        </ul>

        <button><a href="../home/index.html">Back to Homepage</a></button>
    </div>
</body>
</html>
