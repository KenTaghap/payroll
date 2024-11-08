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

// Check if a search term (studentid) is provided
$searchTerm = isset($_GET['studentid']) ? $_GET['studentid'] : '';

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
    <title>View Borrowed Books</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Add your existing CSS here */
    </style>
</head>
<body>
    <div class="container">
        <h1>View Borrowed Books</h1>

        <!-- Search form -->
        <label for="username">Your Student-ID:</label>
        <input type="text" id="id" placeholder="Enter Student-ID" readonly>

        <!-- List to display borrowed book data -->
        <ul class="product-list" id="product-list"></ul>

        <button onclick="window.location.href='../home/index.html'">Back to Homepage</button>
    </div>

    <script>
        // Load Student-ID from localStorage and display borrowed books
        document.addEventListener('DOMContentLoaded', function() {
            const studentId = localStorage.getItem('studentId');
            if (studentId) {
                document.getElementById('id').value = studentId;

                // Fetch and display borrowed books based on student ID
                fetch(`Monitorindex.php?studentid=${studentId}`)
                    .then(response => response.json())
                    .then(data => {
                        const productList = document.getElementById('product-list');
                        productList.innerHTML = '';

                        if (data.length === 0) {
                            productList.innerHTML = '<li>No records found.</li>';
                        } else {
                            data.forEach(product => {
                                const productItem = document.createElement('li');
                                productItem.classList.add('product-item');
                                productItem.innerHTML = `
                                    <div class="product-details"><span>Username:</span><span class="product-info">${product.student}</span></div>
                                    <div class="product-details"><span>BookID:</span><span class="product-info">${product.bookid}</span></div>
                                    <div class="product-details"><span>Book Title:</span><span class="product-info">${product.booktitle}</span></div>
                                    <div class="product-details"><span>Name:</span><span class="product-info">${product.student}</span></div>
                                    <div class="product-details"><span>Borrowed:</span><span class="product-info">${product.borrowed}</span></div>
                                    <div class="product-details"><span>Expiry:</span><span class="product-info">${product.exp}</span></div>
                                `;
                                productList.appendChild(productItem);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            } else {
                document.getElementById('product-list').innerHTML = '<li>Please enter your Student ID.</li>';
            }
        });
    </script>
</body>
</html>
