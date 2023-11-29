<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("connection.php");

if (!isset($_SESSION['id'])) {
    header('location: login.php');
}
if ($_SESSION['type'] == "admin") {
    header('location: dashboard.php');
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Cab Rental Service - Vehicle Fleet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(#FFF9C4, #C5E1A5);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 80px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #FF9800;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #E0F2F1;
        }

        .btn {
            display: inline-block;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .btn-logout {
            display: block;
            margin-top: 20px;
            text-align: center;
        }

        .btn-logout a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #D32F2F;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-logout a:hover {
            background-color: #B71C1C;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Our Vehicle List</h2>
        <table>
            <tr>
                <th>Vehicle Name</th>
                <th>Vehicle Number</th>
                <th>Model</th>
                <th>Transmission</th>
                <th>Fuel Type</th>
                <th>Amount /Day</th>
                <th>Get For Rent</th>
            </tr>
            <?php
            $sqlget = "SELECT * FROM vehicle";
            $sqldata = mysqli_query($conn, $sqlget) or die('error getting');
            while ($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
                echo "<tr><td>";
                echo $row['vehicle_name'];
                echo "</td><td>";
                echo $row['vehi_number'];
                echo "</td><td>";
                echo $row['model'];
                echo "</td><td>";
                echo $row['transmission'];
                echo "</td><td>";
                echo $row['fuel_type'];
                echo "</td><td>";
                echo "Rs." . $row['amount'] . ".00";
                echo "</td><td>";
                echo "<a href='request.php?id=" . $row['id'] . "'><button class='btn'>Get For Rent</button></a>";
                echo "</td></tr>";
            }
            ?>
        </table>
        <div class="btn-logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>

</html>