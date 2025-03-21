<?php
require 'vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Google OAuth Configuration
$client = new Google_Client();
$client->setClientId('861130225282-478rpo3q9r8nln468p2k004qbt6l1sd5.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://teal-marten-604434.hostingersite.com/google-callback.php');
$client->addScope('email');
$client->addScope('profile');

$auth_url = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with Google</title>
</head>
<body>
    <h2>Sign In with Google</h2>
    <a href="<?= htmlspecialchars($auth_url) ?>">Login with Google</a>
</body>
</html>
