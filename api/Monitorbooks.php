<?php
require 'vendor/autoload.php'; // Load Composer's autoloader
error_reporting(E_ERROR | E_PARSE);
// MongoDB connection configuration
$mongoURI = "mongodb+srv://glycerasiado17:glycerasiado17@cluster0.s9v6t.mongodb.net/admin_login";
$dbName = "admin_login";
$collectionName = "books";


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
    $filter = ['book_id' => $searchTerm];
}

// Find documents matching the filter
$cursor = $collection->find($filter);

// Fetch data and store in an array for HTML rendering
$productData = [];
foreach ($cursor as $document) {
    // Assuming 'Data' field contains the binary image data
    $imageData = $document->Data; // Change 'Data' to your actual field name
    $base64Image = base64_encode($imageData); // Convert binary data to base64

    $productData[] = [
        'book_id' => $document->book_id,
        'title' => $document->title,
        'author' => $document->author,
        'published' => $document->published,
        'status' => $document->status,
        'image' => $base64Image, // Add base64 encoded image data to the array
    ];
}

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Books</title>
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
            
        </form>
        
        <ul class="product-list">
            <?php foreach ($productData as $product) : ?>
                <li class="product-item">
                    <div class="product-details">
                        <span>bookID:</span>
                        &nbsp;&nbsp;
                        <span class="product-info"><?php echo $product['book_id']; ?></span>
                    </div>
                    <div class="product-details">
                        <div class="product-image">
                            <?php
                            if (isset($product['image']) && !empty($product['image'])) {
                                echo '<img src="data:image/jpeg;base64,' . $product['image'] . '" class="product-image" alt="Product Image">';
                            } else {
                                echo 'Image not available';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="product-details">
                        <span>Title:</span>
                        &nbsp;&nbsp;
                        <span class="product-info"><?php echo $product['title']; ?></span>
                    </div>
                    <div class="product-details">
                        <span>Author:</span>
                        &nbsp;&nbsp;
                        <span class="product-info"><?php echo $product['author']; ?></span>
                    </div>
                    <div class="product-details">
                        <span>Published:</span>
                        &nbsp;&nbsp;
                        <span class="product-info"><?php echo $product['published']; ?></span>
                    </div>
                    <div class="product-details">
                        <span>Status:</span>
                        &nbsp;&nbsp;
                        <span class="product-info"><?php echo $product['status']; ?></span>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <button><a href="../home/index.html">Back to Homepage</a></button>
    </div>
</body>
</html>
