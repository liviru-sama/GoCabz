<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include "connection.php";

if (isset($_SESSION['id'])) {
    if ($_SESSION['type'] == "user") {
        echo ("<script LANGUAGE='JavaScript'> window.alert('Unauthorized'); window.location.href='index.php';  </script>");
    } elseif ($_SESSION['type'] == "admin") {
        header('location: dashboard.php');
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (
        !empty($username) &&
        !empty($password)
    ) {
        $query = "SELECT * FROM admins WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if (password_verify($_POST['password'], $user_data["password"])) {
                    $_SESSION["id"] = $user_data["id"];
                    $_SESSION["type"] = "admin";
                    header("Location:dashboard.php");
                    die();
                } else {
                    echo ("<script LANGUAGE='JavaScript'> window.alert('wrong username or password'); </script>");
                }
            } else {
                echo ("<script LANGUAGE='JavaScript'> window.alert('Admin Doesnt exist'); </script>");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cab Rental Service - Admin Login</title>
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
            background-color: #fff;
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
        <h2>Admin Login</h2>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" placeholder="Enter admin username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Enter admin password" name="password" required>
            </div>
            <div class="form-group btn-container">
                <input type="submit" value="Login" class="btn">
                <a href="index.php" class="btn btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>