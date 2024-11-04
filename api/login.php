<?php
require 'vendor/autoload.php';

error_reporting(E_ERROR | E_PARSE);

use MongoDB\Client as MongoClient;

// Connect to MongoDB Atlas
try {
    $mongoClient = new MongoClient("mongodb+srv://glycerasiado17:glycerasiado17@cluster0.s9v6t.mongodb.net/admin_login");
    $database = $mongoClient->admin_login;
    $collection = $database->users;
} catch (Exception $e) {
    die("Error connecting to MongoDB: " . $e->getMessage());
}

$errorMsg = ""; // Initialize an error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query for the user
    $query = ["username" => $username, "password" => $password];
    $user = $collection->findOne($query);

    if ($user) {
        // Redirect or indicate successful login
        header("Location: dashboard.php");
        exit();
    } else {
        $errorMsg = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payroll</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>
<body>
    <header class="header">
        <nav class="nav">
            <button class="button" id="form-open">Login</button>
        </nav>
        <nav class="nav">
            <a href="#" class="nav_logo">Library System</a>
        </nav>
    </header>

    <section class="home">
        <div class="form_container">
            <i class="uil uil-times form_close"></i>
            <div class="form login_form">
                <form action="" method="POST">
                    <h2>Login</h2>
                    <?php if ($errorMsg): ?>
                        <p style="color: red;"><?php echo $errorMsg; ?></p>
                    <?php endif; ?>
                    <div class="input_box">
                        <input type="text" name="username" id="username" placeholder="Enter your username" required />
                        <i class="uil uil-envelope-alt email"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" name="password" id="password" placeholder="Enter your password" required />
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>
                    <button type="submit" class="button">Login Now</button>
                </form>
            </div>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>
