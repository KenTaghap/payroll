<?php
require 'config.php';

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($token['error'])) {
        $client->setAccessToken($token);
        
        $oauth = new Google_Service_Oauth2($client);
        $user_info = $oauth->userinfo->get();

        $_SESSION['user'] = [
            'id' => $user_info->id,
            'name' => $user_info->name,
            'email' => $user_info->email,
            'picture' => $user_info->picture
        ];

        header("Location: welcome.php");
        exit();
    }
}

header("Location: index.html");
exit();
?>
