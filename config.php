<?php
require 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setClientId('861130225282-478rpo3q9r8nln468p2k004qbt6l1sd5.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://teal-marten-604434.hostingersite.com/callback.php');
$client->addScope('email');
$client->addScope('profile');
?>
