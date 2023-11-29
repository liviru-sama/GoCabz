<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include "connection.php";

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
    <title>Cab Rental Service - Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(#FEF9E7, #C5E1A5);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 80px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            margin-top: 0;
            font-size: 32px;
            color: #689F38;
        }

        .welcome {
            margin-bottom: 20px;
        }

        .stats-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .stat-box {
            flex-basis: 30%;
            padding: 60px;
            background-color: #CDDC39;
            border-radius: 40px;
            color: #fff;
            text-align: center;
        }

        .stat-title {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 36px;
        }

        .btn {
            display: inline-block;
            padding: 20px 40px;
            background-color: #689F38;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 24px;
            margin-top: 30px;
        }

        .btn-logout {
            background-color: #D32F2F;
        }

        .btn-add-admin {
            background-color: #689F38;
        }

        .btn:hover,
        .btn-logout:hover,
        .btn-add-admin:hover {
            background-color: #558B2F;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <div class="welcome">
            <?php
            $uid = $_SESSION['id'];
            $sqlget = "SELECT username FROM admins WHERE id=$uid LIMIT 1";
            $sqlget1 = "SELECT * FROM vehicle";
            $sqlget2 = "SELECT * FROM requests";
            $sqldata = mysqli_query($conn, $sqlget) or die('error getting');
            $sqldata1 = mysqli_query($conn, $sqlget1) or die('error getting');
            $sqldata2 = mysqli_query($conn, $sqlget2) or die('error getting');
            $row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC);
            ?>
            <h3>Welcome, Admin!
                <?php echo $row['username'] ?>
            </h3>
        </div>
        <div class="stats-container">
            <div class="stat-box">
                <div class="stat-title">Total Available Vehicles in Database</div>
                <div class="stat-value">
                    <?php echo mysqli_num_rows($sqldata1) ?>
                </div>
            </div>
            <div class="stat-box">
                <div class="stat-title">Number of Current Requests</div>
                <div class="stat-value">
                    <?php echo mysqli_num_rows($sqldata2) ?>
                </div>
            </div>
        </div>
        <a href="pending.php" class="btn btn-pending-requests">See Pending Requests</a>
        <a href="managevehicle.php" class="btn btn-add-vehicle">Manage Vehicles</a>
        <a href="addadmin.php" class="btn btn-add-admin">Add Administrators</a>
        <div style="text-align: center; margin-top: 30px;">
            <a href="logout.php" class="btn btn-logout">Logout</a>
        </div>
    </div>
</body>

</html>