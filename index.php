<?php

require __DIR__ . "/vendor/autoload.php";

$client = new Google\Client;

$client->setClientId("861130225282-478rpo3q9r8nln468p2k004qbt6l1sd5.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("https://payroll-pi.vercel.app/redirect.php");

$client->addScope("email");
$client->addScope("profile");

$url = $client->createAuthUrl();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Google Login Example</title>
</head>
<body>

    <a href="<?= $url ?>">Sign in with Google</a>

</body>
</html>