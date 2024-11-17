<?php
require 'vendor/autoload.php'; // Load Composer's autoloader
error_reporting(E_ERROR | E_PARSE);

// MongoDB connection configuration
$mongoURI = "mongodb+srv://glycerasiado17:glycerasiado17@cluster0.s9v6t.mongodb.net/admin_login";
$dbName = "admin_login";
$collectionName = "date";

// Create a MongoDB client
$mongoClient = new MongoDB\Client($mongoURI);

// Select database and collection
$database = $mongoClient->$dbName;
$collection = $database->$collectionName;

// Check if a search term (book ID) is provided
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Filter for searching by book_id
$filter = [];
if (!empty($searchTerm)) {
    $filter = ['id' => $searchTerm];
}

// Find documents matching the filter
$cursor = $collection->find($filter);

// Fetch data and store in an array for HTML rendering
$productData = [];
foreach ($cursor as $document) {
    $productData[] = [
        'id' => $document->book_id,
        'name' => $document->title,
        'section' => $document->author,
        'book' => $document->published,
        'date' => $document->status,
    ];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dates</title>
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
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
        }
        h1 {
            text-align: center;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
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
        .product-image img {
            max-width: 100px;
            margin-right: 20px;
            margin-bottom: 10px;
        }
        .product-details span {
            font-weight: bold;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
        <h1>Date List</h1>

        <!-- Search form -->
        <form action="" method="GET">
            <input type="text" name="search" placeholder="Search by Book ID">
            <input type="submit" value="Search">
        </form>

        <!-- Display books -->
        <ul class="product-list">
            <?php if (empty($productData)): ?>
                <li class="product-item">No Dates found.</li>
            <?php else: ?>
                <?php foreach ($productData as $product) : ?>
                    <li class="product-item">
                        <div class="product-details">
                            <span>Student ID:</span>
                            &nbsp;&nbsp;
                            <span class="product-info"><?php echo htmlspecialchars($product['id']); ?></span>
                        </div>
                        <div class="product-details">
                            <span>FullName:</span>
                            &nbsp;&nbsp;
                            <span class="product-info"><?php echo htmlspecialchars($product['name']); ?></span>
                        </div>
                        <div class="product-details">
                            <span>Section:</span>
                            &nbsp;&nbsp;
                            <span class="product-info"><?php echo htmlspecialchars($product['section']); ?></span>
                        </div>
                        <div class="product-details">
                            <span>Book:</span>
                            &nbsp;&nbsp;
                            <span class="product-info"><?php echo htmlspecialchars($product['book']); ?></span>
                        </div>
                        <div class="product-details">
                            <span>Date:</span>
                            &nbsp;&nbsp;
                            <span class="product-info"><?php echo htmlspecialchars($product['date']); ?></span>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>

        <button><a href="../home/index.html">Back to Homepage</a></button>
    </div>
</body>
</html>
