<?php
require 'vendor/autoload.php';

error_reporting(E_ERROR | E_PARSE);

use MongoDB\Client;

// Replace with your MongoDB Atlas connection string
$connectionString = "mongodb+srv://Payroll:Payroll2023@payroll.hzvfjqq.mongodb.net/payroll_app?retryWrites=true&w=majority";

try {
    $client = new Client($connectionString);
    $collection = $client->payroll_app->people; // Replace with your database and collection names

    // Retrieve user information by name
    $username = $_POST['info'];

    $filter = ['username' => $username];
    $userInfo = $collection->findOne($filter);

    if ($userInfo) {
        $userfullname = $userInfo['fullname'];
        $userage = $userInfo['age'];
		$useraddress = $userInfo['address'];
        $usercnumber = $userInfo['cnumber'];
		$useremail = $userInfo['email'];
		$userbirthday = $userInfo['birthday'];
		$userpassword = $userInfo['password'];
		$userusername = $userInfo['username'];

	
    } else {
        $userfullname = "User not found";
        $useraddress = "";
        $userusername = "";
		$userpassword = "";
        $useremail = "";
		$userbirthday = "";
        $usercnumber = "";
		$userage = "";
		$userusername = "";
    }
} catch (MongoDB\Driver\Exception\Exception $e) {
		$userfullname = "Not connected";
        $useraddress = "";
        $userusername = "";
		$userpassword = "";
        $useremail = "";
		$userbirthday = "";
        $usercnumber = "";
		$userage = "";
		$userusername = "";
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
			<div class="form-left">
				
				
			<div class="form-right">
				<div class="tab">
					<div class="tab-inner">
						<button class="tablinks" onclick="openCity(event, 'sign-up')" id="defaultOpen">Account</button>
					</div>
					<div class="tab-inner">
						<button class="tablinks" onclick="openCity(event, 'sign-in')">Modify</button>
					</div>
				</div>
				<form class="form-detail" action="myacc.php" method="POST">
				<center>
				<h4 style="color:white;">Please Input your username, then hit enter.<br><input type="text" name="info" id="info"></h4>
				
				</center>
				
					<div class="tabcontent" id="sign-up">
					
								<p><strong>Fullname:</strong>&nbsp; &nbsp;  <?= $userfullname ?></p>
								<p ><strong>Address:</strong>&nbsp; &nbsp;  <?= $useraddress ?></p>
								<p ><strong>Username:</strong>&nbsp; &nbsp;  <?= $userusername ?></p>
								<p><strong>Password:</strong>&nbsp; &nbsp;  <?= $userpassword ?></p>
    							<p><strong>Email:</strong>&nbsp; &nbsp;  <?= $useremail ?></p>
								<p><strong>Birthday:</strong>&nbsp; &nbsp;  <?= $userbirthday ?></p>
								<p><strong>C# Number:</strong>&nbsp; &nbsp;  <?= $usercnumber ?></p>
								<p><strong>Age:</strong>&nbsp; &nbsp;  <?= $userage ?></p>
								
								<br>
								<br>
								<br>
						<div class="form-row-last">
							<button><a href="../home/index.html" class="register">Back </a></button>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br> 
								<br>
								<br>
								<br>
								<br>
								
						</div>
					</div>
				</form>



				<form class="form-detail" action="myaccupdate.php" method="POST">
					<div class="tabcontent" id="sign-in">
								<input placeholder="Fullname" value="<?= $userfullname ?>" type="text" name="fullname" id="fullname" class="input-text" required >
								<input placeholder="Address" value="<?= $useraddress ?>" type="text" name="address" id="address" class="input-text" required>
								
								<input placeholder="Username" value="<?= $userusername ?>" type="text" name="username" id="username" class="input-text" readonly>
								<input placeholder="Password" value="<?= $userpassword ?>" type="text" name="password" id="password" class="input-text" required>
								&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
								&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
								<input placeholder="Birthday" value="<?= $userbirthday ?>" type="date" name="birthday" id="birthday" class="input-text" required>
								<input placeholder="Contact #" value="<?= $usercnumber ?>" type="Number" name="cnumber" id="cnumber" class="input-text" required>
								<input placeholder="Age" value="<?= $userage ?>" type="Number" name="age" id="age" class="input-text" required>
								<input placeholder="Email" value="<?= $useremail ?>" type="text" name="email" id="email" class="input-text" required>
								

						<div class="form-row-last">
							<input type="submit" name="register" class="register" value="Edit">
						</div>
					</div>
				</form>
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
