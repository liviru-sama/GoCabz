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

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $con_pass = $_POST['cpassword'];

    if (!empty($username) && !empty($password) && !empty($con_pass)) {
        if ($password == $con_pass) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO admins (username,password) VALUES ('$username','$password')";
            mysqli_query($conn, $query);
            echo ("<script LANGUAGE='JavaScript'> window.alert('Admin Added Successful!!!'); window.location.href='dashboard.php'; </script>");
        } else {
            echo ("<script LANGUAGE='JavaScript'> window.alert('Password Doesnt match'); </script>");
        }
    } else {
        echo ("<script LANGUAGE='JavaScript'> window.alert('Please Enter Valid Information'); </script>");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Admin - Cab Rental Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(#FFF9C4, #C5E1A5);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 400px;
            margin: 80px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 18px;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .btn-cancel {
            background-color: #f44336;
            margin-right: 10px;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Add Admin</h1>
        <form method="POST">
            <div class="form-group">
                <label for="username">Admin Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Admin Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="cpassword" id="confirm_password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Add Admin" class="btn">
                <a href="dashboard.php" class="btn btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>