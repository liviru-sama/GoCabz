<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include "connection.php";

if (!isset($_SESSION['id'])) {
    header('location: login.php');
}
if ($_SESSION['type'] == "admin") {
    header('location: dashboard.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $uid = $_SESSION['id'];
    $sqlget = "SELECT * FROM vehicle WHERE id=$id LIMIT 1";
    $sqlget1 = "SELECT user_name,email FROM users WHERE id=$uid LIMIT 1";
    $sqldata = mysqli_query($conn, $sqlget) or die('error getting');
    $sqldata1 = mysqli_query($conn, $sqlget1) or die('error getting');
    $row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC);
    $row1 = mysqli_fetch_array($sqldata1, MYSQLI_ASSOC);
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $vehicle_name = $_POST['vehicle_name'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $period = $_POST['period'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];
    $advance = $_POST['advance'];

    if (!empty($period) && !empty($address) && !empty($contact_no) && !empty($advance)) {
        $query = "INSERT INTO requests (vehicle_name,user_name,email,period,address,contact_no,advance) VALUES ('$vehicle_name','$user_name','$email','$period','$address','$contact_no','$advance')";
        mysqli_query($conn, $query);
        echo ("<script LANGUAGE='JavaScript'> window.alert('Request Recorded'); window.location.href='book.php'; </script>");
    } else {
        echo ("<script LANGUAGE='JavaScript'> window.alert('Please Enter Valid Information'); </script>");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cab Rental Service - Rent Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(#FFF9C4, #C5E1A5);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 80px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .btn-container {
            text-align: left;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }

        .btn-cancel {
            background-color: #f44336;
            margin-right: 10px;
        }

        .btn:hover,
        .btn-cancel:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Rent Request</h2>
        <form method="post">
            <div class="form-group">
                <label for="vehicle-name">Vehicle Name</label>
                <input type="text" id="vehicle-name" placeholder="Enter vehicle name"
                    value="<?php echo $row['vehicle_name'] ?>" name="vehicle_name" readonly>
            </div>
            <div class="form-group">
                <label for="person-name">Request Person's Name</label>
                <input type="text" id="person-name" placeholder="Enter request person's name"
                    value="<?php echo $row1['user_name'] ?>" name="user_name" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Enter email" value="<?php echo $row1['email'] ?>"
                    name="email" readonly>
            </div>
            <div class="form-group">
                <label for="rental-period">Rental Period (in days)</label>
                <input type="number" id="rental-period" placeholder="Enter rental period" name="period">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" placeholder="Enter address" name="address">
            </div>
            <div class="form-group">
                <label for="contact-number">Contact Number</label>
                <input type="text" id="contact-number" placeholder="Enter contact number" name="contact_no">
            </div>
            <div class="form-group">
                <label for="advance-amount">Advanced Payment Amount</label>
                <input type="number" id="advance-amount" placeholder="Enter advanced payment amount" name="advance">
            </div>
            <div class="form-group btn-container">
                <input type="submit" value="Submit" class="btn">
                <a href="book.php" class="btn btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>