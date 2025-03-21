<?php
require 'vendor/autoload.php';
require 'config.php'; // Include database connection

session_start();

$client = new Google_Client();
$client->setClientId('861130225282-478rpo3q9r8nln468p2k004qbt6l1sd5.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://teal-marten-604434.hostingersite.com/google-callback.php');
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    $oauth2 = new Google_Service_Oauth2($client);
    $userInfo = $oauth2->userinfo->get();

    $google_id = $userInfo->id;
    $name = $userInfo->name;
    $email = $userInfo->email;
    $profile_picture = $userInfo->picture;

    // Check if user exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE google_id = ?");
    $stmt->execute([$google_id]);
    $user = $stmt->fetch();

    if (!$user) {
        // Insert new user
        $stmt = $pdo->prepare("INSERT INTO users (google_id, name, email, profile_picture) VALUES (?, ?, ?, ?)");
        $stmt->execute([$google_id, $name, $email, $profile_picture]);
    }

    // Store user session
    $_SESSION['user'] = [
        'id' => $google_id,
        'name' => $name,
        'email' => $email,
        'picture' => $profile_picture
    ];

    header('Location: dashboard.php');
    exit();
} else {
    echo "Authentication failed!";
}
?>
