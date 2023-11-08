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
        $hoursWorked = $userInfo['hoursWorked'];
        $hourlyRate = $userInfo['hourlyRate'];

	
    } else {
        $hoursWorked = "not found";
        $hourlyRate = "";
    }
} catch (MongoDB\Driver\Exception\Exception $e) {
    $hoursWorked = "not connected";
    $hourlyRate = "";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Payroll System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-image: url('a.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
        
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Payroll System</h2>
    <form action="attendance.php" method="POST">
        <label> Enter username :</label>
        <input type="text" id="info" name="info" placeholder="Username" required>

        <label for="hoursWorked">Hours Worked:</label>
        <input type="number" value="<?= $hoursWorked ?>" id="hoursWorked" name="hoursWorked" placeholder="none" readonly>

        <label for="hourlyRate">Hourly Rate:</label>
        <input type="number" value="<?= $hourlyRate ?>" id="hourlyRate" name="hourlyRate" placeholder="none" readonly>
        <br>
        <input type="submit" style="color: green;" value="display">
        </form>
        <center>

        <button  onclick="calculatePay()">Calculate Pay</button>
        <button type="button" onclick="clearForm()">Clear</button>
<br><br>
        <label for="totalPay">Total Pay:</label>
        <input type="text" id="totalPay" name="totalPay" readonly>
    </center>

    <script>
        function calculatePay() {
            const hoursWorked = parseFloat(document.getElementById('hoursWorked').value);
            const hourlyRate = parseFloat(document.getElementById('hourlyRate').value);

            if (!isNaN(hoursWorked) && !isNaN(hourlyRate)) {
                const totalPay = hoursWorked * hourlyRate;
                document.getElementById('totalPay').value = totalPay.toFixed(2);
            } else {
                alert('Cannot Find Your hours worked and hourly rate.');
            }
        }

        function clearForm() {
            document.getElementById('info').value = '';
            document.getElementById('hoursWorked').value = '';
            document.getElementById('hourlyRate').value = '';
            document.getElementById('totalPay').value = '';
        }
    </script>
    <button><a href="../home/index.html" class="register">Back </a></button>
</body>
</html>
