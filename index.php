<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include "connection.php";

if (isset($_SESSION['id'])) {
    if ($_SESSION['type'] == "user") {
        header('location: book.php');
    } elseif ($_SESSION['type'] == "admin") {
        header('location: dashboard.php');
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Cab Rental Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .hero {
            height: 100vh;
            background-image: url('images/background.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
        }

        .hero-content {
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            font-size: 48px;
            color: black;
            margin-bottom: 30px;
        }

        h1 span {
            font-size: 58px;
        }

        p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        p span {
            color: brown;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .cta-button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 20px;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #45a049;
        }

        .logo {
            width: 400px;
            height: auto;
            margin-bottom: 20px;
        }

        .section {
            padding: 80px 0;
            text-align: center;
        }

        .section h2 {
            font-size: 36px;
            margin-bottom: 30px;
        }

        .section p {
            font-size: 18px;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="hero">
        <div class="hero-content">
            <img src="images/logo.png" alt="Logo" class="logo">
            <h1>Welcome to GoCabz <span>🚗</span> Cab Rental Service</h1>
            <p><span>Book your next ride with ease and convenience</span></p>
            <div class="cta-buttons">
                <a href="login.php" class="cta-button">Login</a>
                <a href="signup.php" class="cta-button" style="background-color: #f44336;">Sign Up</a>
                <a href="help.html" class="cta-button" style="background-color: #130678;">Help</a>
            </div>
            <p style="color: blue;">Are you an admin? <a href="admin.php">click here</a></p>
        </div>
    </div>
</body>

</html>