<?php
require 'vendor/autoload.php';
error_reporting(E_ERROR | E_PARSE);
use MongoDB\Client;

// Replace with your MongoDB Atlas connection string
$connectionString = "mongodb+srv://glycerasiado17:glycerasiado17@cluster0.s9v6t.mongodb.net/admin_login";

$studentid = "";
$bookid = "";
$booktitle = "";
$student = "";
$exp = "";
$borrowed = "";


try {
    $client = new Client($connectionString);
    $collection = $client->admin_login->borrowed; // Replace with your database and collection names

    if (isset($_POST['studentid'])) {
        $studentid = $_POST['studentid'];

        $filter = ['studentid' => $studentid];
        $userInfo = $collection->findOne($filter);

        if ($userInfo) {
            $studentid = $userInfo['studentid'];
            $bookid = $userInfo['bookid'];
            $booktitle = $userInfo['booktitle'];
            $student = $userInfo['student'];
            $exp = $userInfo['exp'];
            $borrowed = $userInfo['borrowed'];
           
        } else {
            $studentid = "User not found";
            // Set other fields to default or empty values
        }
    } else {
        // Handle case where 'Username' is not set in $_POST
        $studentid = "Please Click Display Button.";
        // Set other fields to default or empty values
    }
} catch (MongoDB\Driver\Exception\Exception $e) {
    // Handle MongoDB exceptions
    $studentid = "Error retrieving user information";
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
				
					
				
				<form class="form-detail" action="Monitorindex.php" method="POST">
				<center>
				<h4 style="color:white;">Your Student-ID,&nbsp; &nbsp;
				 <input type="text" name="studentid" id="studentid" />
    <script>
        // Retrieve the username from localStorage and display it in the input field
        document.getElementById("studentid").value = localStorage.getItem("studentId") || "none";
    </script>

					<div class="tabcontent" id="sign-up">
					
								<p><strong>Student Id:</strong>&nbsp; &nbsp;  <?= $studentid ?></p>
								<p ><strong>BookID:</strong>&nbsp; &nbsp;  <?= $bookid ?></p>
								<p><strong>Book Title:</strong>&nbsp; &nbsp;  <?= $booktitle ?></p>
								<p><strong>Student:</strong>&nbsp; &nbsp;  <?= $student ?></p>
    							<p><strong>Exp:</strong>&nbsp; &nbsp;  <?= $exp ?></p>
								<p><strong>Borrowed:</strong>&nbsp; &nbsp;  <?= $borrowed ?></p>
							


								
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
