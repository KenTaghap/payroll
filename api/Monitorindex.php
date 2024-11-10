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

        label {
            margin-right: 10px;
        }

        input[type="text"] {
            padding: 5px;
            border-radius: 5px;
            border: none;
            width: 100%;
            max-width: 300px;
            display: block;
            margin: 0 auto 20px auto;
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
            background-color: #4CAF50;
            color: white;
            text-align: center;
            display: block;
            margin: 20px auto;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>View Borrowed Books</h1>

        <!-- Search form -->
        <label for="username">Your Student-ID:</label>
        <input type="text" id="id" placeholder="Enter Student-ID" readonly>

        <!-- Display button -->
        <button id="display-button">Display Borrowed Books</button>

        <!-- List to display borrowed book data -->
        <ul class="product-list" id="product-list"></ul>

        <button onclick="window.location.href='../home/index.html'">Back to Homepage</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load Student-ID from localStorage
            const studentId = localStorage.getItem('studentId');
            if (studentId) {
                document.getElementById('id').value = studentId;
            }

            // Fetch and display borrowed books when "Display" button is clicked
            document.getElementById('display-button').addEventListener('click', function() {
                if (studentId) {
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
        });
    </script>
</body>
</html>
