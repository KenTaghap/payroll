<?php
require 'config.php';

$login_url = $client->createAuthUrl();
header("Location: " . $login_url);
exit();
?>
