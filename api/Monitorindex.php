<?php
require 'vendor/autoload.php'; // Load Composer's autoloader
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

// Check if a search term (username) is provided
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Find documents based on the search term (username)
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
            background-color: rgba(0, 0, 0, 0.8);
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
            padding: 15px;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .product-details {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 5px 0;
        }

        .product-details span:first-child {
            font-weight: bold;
            flex: 1;
        }

        .product-info {
            flex: 2;
            text-align: left;
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
            text-align: center;
        }

        button a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>View Books</h1>

        <!-- Search form -->
        <form action="" method="GET">
            <label for="search">Search by Student-ID:</label>
            <input type="text" id="search" name="search" placeholder="Enter student id" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <input type="submit" value="Search">
        </form>

        <ul class="product-list">
            <?php foreach ($productData as $product) : ?>
                <li class="product-item">
                    <div class="product-details">
                        <span>StudentID:</span>
                        <span class="product-info"><?php echo $product['studentid']; ?></span>
                    </div>
                    <div class="product-details">
                        <span>BookID:</span>
                        <span class="product-info"><?php echo $product['bookid']; ?></span>
                    </div>
                    <div class="product-details">
                        <span>Book Title:</span>
                        <span class="product-info"><?php echo $product['booktitle']; ?></span>
                    </div>
                    <div class="product-details">
                        <span>Name:</span>
                        <span class="product-info"><?php echo $product['student']; ?></span>
                    </div>
                    <div class="product-details">
                        <span>Borrowed:</span>
                        <span class="product-info"><?php echo $product['borrowed']; ?></span>
                    </div>
                    <div class="product-details">
                        <span>Expiry:</span>
                        <span class="product-info"><?php echo $product['exp']; ?></span>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <button><a href="../home/index.html">Back to Homepage</a></button>
    </div>
</body>
</html>
