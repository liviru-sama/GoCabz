<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("connection.php");

if (!isset($_SESSION['id'])) {
    header('Location: admin.php');
}
else {
    if ($_SESSION['type'] == "user") {
        echo ("<script LANGUAGE='JavaScript'> window.alert('Unauthorized'); window.location.href='index.php';  </script>");
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Cab Rental Service - Manage Vehicles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(#FFF9C4, #C5E1A5);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
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

        .btn-container {
            padding: 5px 10px;
            display: flex;
            justify-content: left;
        }

        .btn {
            display: inline-block;
            padding: 5px 15px;
            background-color: #4CAF50;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            margin: 0 5px;
        }

        .btn.update {
            background-color: #1976D2;
        }

        .btn.delete {
            background-color: #D32F2F;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .btn.delete:hover {
            background-color: #B71C1C;
        }

        .btn.add-new {
            display: block;
            margin-top: 20px;
        }

        .btn.dashboard {
            background-color: #1976D2;
            display: block;
            margin-top: 20px;
        }

        .btn.dashboard:hover {
            background-color: green;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Manage Vehicles</h2>
        <table>
            <tr>
                <th>Vehicle Name</th>
                <th>Vehicle Number</th>
                <th>Model</th>
                <th>Transmission</th>
                <th>Fuel Type</th>
                <th>Amount</th>
                <th>Action</th>
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
                echo "</td><td class='btn-container'>";
                echo "<a href='addvehicle.php?id=" . $row['id'] . "&edit=yes" . "'><button class='btn update'>Update</button></a>";
                echo "<a href='addvehicle.php?id=" . $row['id'] . "&delete=yes" . "'><button class='btn delete'>Delete</button></a>";
                echo "</td></tr>";
            }
            ?>
        </table>
        <div class=btn-container>
            <a href="addvehicle.php" class="btn add-new">Add New Vehicle</a>
            <a href="dashboard.php" class="btn dashboard">Dashboard</a>
        </div>
    </div>
</body>

</html>