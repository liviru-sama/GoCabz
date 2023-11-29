<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("connection.php");

if (isset($_SESSION['id'])) {
    if ($_SESSION['type'] == "user") {
        header('location: book.php');
    } elseif ($_SESSION['type'] == "admin") {
        header('location: dashboard.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $con_pass = $_POST['cpassword'];

    if (!empty($user_name) && !empty($password) && !empty($email) && !empty($con_pass)) {
        if ($password == $con_pass) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "insert into users (user_name,email,password) values ('$user_name','$email','$password')";
            mysqli_query($conn, $query);
            echo ("<script LANGUAGE='JavaScript'> window.alert('Sign Up Successful!!!'); window.location.href='login.php'; </script>");
        } else {
            echo ("<script LANGUAGE='JavaScript'> window.alert('Password Doesnt match'); </script>");
        }
    } else {
        echo ("<script LANGUAGE='JavaScript'> window.alert('Please Enter Valid Information'); </script>");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cab Rental Service - Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/background.jpg');
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

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 90%;
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
        <h2>Sign Up</h2>
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" placeholder="Enter your username" name="user_name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Enter your email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Enter your password" name="password">
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" placeholder="Confirm your password" name="cpassword">
            </div>
            <div class="form-group btn-container">
                <input type="submit" class="btn" name="SignUp" value="Sign Up">
                <a href="index.php" class="btn btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>