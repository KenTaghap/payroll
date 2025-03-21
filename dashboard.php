<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$email = $_SESSION['user']['email'];

// Fetch user details from database
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?= htmlspecialchars($user['name']) ?></h2>
    <img src="<?= htmlspecialchars($user['profile_picture']) ?>" alt="Profile Picture">
    <p>Email: <?= htmlspecialchars($user['email']) ?></p>
    <p>Account Created: <?= htmlspecialchars($user['created_at']) ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
