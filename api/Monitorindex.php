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

// Check if a search term (book ID) is provided
$searchTerm = isset($_GET['studentid']) ? $_GET['studentid'] : '';

// Filter for searching by book_id
$filter = [];
if (!empty($searchTerm)) {
    $filter = ['studentid' => $searchTerm]; // Only filter by book_id if provided
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

// If no search term is provided, initialize $productData as empty to display "No books found"
if (empty($searchTerm)) {
    $productData = []; // Make sure no data is fetched by default if no search term is provided
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Books</title>
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
        <h1>Books List</h1>

        <!-- Search form -->
        <form action="" method="GET">
            <input type="text" name="studentid" id="studentid" placeholder="Enter Book ID to search" value="<?php echo htmlspecialchars($searchTerm); ?>" readonly/>
             <script>
        // Retrieve the username from localStorage and display it in the input field
        document.getElementById("studentid").value = localStorage.getItem("studentId") || "none";
    </script>
            <input type="submit" value="Display">
        </form>

        <!-- Display books -->
        <ul class="product-list">
            <?php if (empty($productData)): ?>
                <li class="product-item">No books found.</li>
            <?php else: ?>
                <?php foreach ($productData as $product) : ?>
                    <li class="product-item">
                        <div class="product-details">
                            <span>Student ID:</span>
                            &nbsp;&nbsp;
                            <span class="product-info"><?php echo htmlspecialchars($product['studentid']); ?></span>
                        </div>
                       <div class="product-details">
                            <span>Book ID:</span>
                            &nbsp;&nbsp;
                            <span class="product-info"><?php echo htmlspecialchars($product['bookid']); ?></span>
                        </div>
                        <div class="product-details">
                            <span>Book Title:</span>
                            &nbsp;&nbsp;
                            <span class="product-info"><?php echo htmlspecialchars($product['booktitle']); ?></span>
                        </div>
                        <div class="product-details">
                            <span>Student Name:</span>
                            &nbsp;&nbsp;
                            <span class="product-info"><?php echo htmlspecialchars($product['student']); ?></span>
                        </div>
                        <div class="product-details">
                            <span>Expiry:</span>
                            &nbsp;&nbsp;
                            <span class="product-info"><?php echo htmlspecialchars($product['exp']); ?></span>
                        </div>
                        <div class="product-details">
                            <span>Status:</span>
                            &nbsp;&nbsp;
                            <span class="product-info"><?php echo htmlspecialchars($product['borrowed']); ?></span>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>

        <button><a href="../home/index.html">Back to Homepage</a></button>
    </div>
</body>
</html>
