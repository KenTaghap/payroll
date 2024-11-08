<?php
require 'vendor/autoload.php';
error_reporting(E_ERROR | E_PARSE);
use MongoDB\Client;

// Replace with your MongoDB Atlas connection string
$connectionString = "mongodb+srv://glycerasiado17:glycerasiado17@cluster0.s9v6t.mongodb.net/admin_login";

$userid = "";
$username = "";
$usersection = "";
$usercontact = "";
$userusername = "";
$userpass = "";


try {
    $client = new Client($connectionString);
    $collection = $client->admin_login->users; // Replace with your database and collection names

    if (isset($_POST['username'])) {
        $username = $_POST['username'];

        $filter = ['username' => $username];
        $userInfo = $collection->findOne($filter);

        if ($userInfo) {
            $userid = $userInfo['id'];
            $username = $userInfo['name'];
            $usersection = $userInfo['section'];
            $usercontact = $userInfo['contact'];
            $userusername = $userInfo['username'];
            $userpass = $userInfo['password'];
           
        } else {
            $username = "User not found";
            // Set other fields to default or empty values
        }
    } else {
        // Handle case where 'Username' is not set in $_POST
        $username = "Please Click Display Button.";
        // Set other fields to default or empty values
    }
} catch (MongoDB\Driver\Exception\Exception $e) {
    // Handle MongoDB exceptions
    $username = "Error retrieving user information";
    // Set other fields to default or empty values
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Farmers Account</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="../home/myAcc/css/sourcesanspro-font.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="../home/myAcc/css/style.css"/>
</head>
<body class="form-v8">
	
	<div class="page-content">
		<div class="form-v8-content">
			
			<div class="form-right">
				
					
				
				<form class="form-detail" action="myAccindex.php" method="POST">
				<center>
				<h4 style="color:white;">Your personal Info,&nbsp; &nbsp;
				<input type="text" name="displayUsername" id="displayUsername"  readonly></h4>
				<script>
					// Retrieve the username from localStorage and display it
        document.getElementById("displayUsername").innerText = localStorage.getItem("username") || "Guest";
				</script>
				</center>
				
					<div class="tabcontent" id="sign-up">
					
								<p><strong>Student Id:</strong>&nbsp; &nbsp;  <?= $userid ?></p>
								<p ><strong>Name:</strong>&nbsp; &nbsp;  <?= $username ?></p>
								<p><strong>Section:</strong>&nbsp; &nbsp;  <?= $usersection ?></p>
								<p><strong>Contact No.:</strong>&nbsp; &nbsp;  <?= $usercontact ?></p>
    							<p><strong>Username:</strong>&nbsp; &nbsp;  <?= $userusername ?></p>
								<p><strong>Password:</strong>&nbsp; &nbsp;  <?= $userpass ?></p>
							


								
								<div class="form-row-last">
					
								<input type="submit" name="register" class="register" value="Display">
						</div>
								</form>
								<br>
								<br>
								<br>
						<div class="form-row-last">
							<button><a href="../home/index.html" class="register">Back </a></button>
								<br>
								<br>
								<br>
								
						</div>
					</div>
				
					
				
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function openCity(evt, cityName) {
		    var i, tabcontent, tablinks;
		    tabcontent = document.getElementsByClassName("tabcontent");
		    for (i = 0; i < tabcontent.length; i++) {
		        tabcontent[i].style.display = "none";
		    }
		    tablinks = document.getElementsByClassName("tablinks");
		    for (i = 0; i < tablinks.length; i++) {
		        tablinks[i].className = tablinks[i].className.replace(" active", "");
		    }
		    document.getElementById(cityName).style.display = "block";
		    evt.currentTarget.className += " active";
		}

		// Get the element with id="defaultOpen" and click on it
		document.getElementById("defaultOpen").click();
	</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
