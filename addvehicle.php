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

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $vehicle_name = $_POST['vehicle_name'];
    $vehicle_number = $_POST['vehicle_number'];
    $model = $_POST['model'];
    $transmission = $_POST['transmission'];
    $fuel_type = $_POST['fuel_type'];
    $rent_amount = $_POST['rent_amount'];

    if (isset($_GET['edit'])) {
        $edit_id = $_POST['id'];
        $query = "UPDATE vehicle SET vehicle_name='$vehicle_name', vehi_number='$vehicle_number',model='$model',transmission='$transmission',fuel_type='$fuel_type',amount='$rent_amount' WHERE id='$edit_id'";
        mysqli_query($conn, $query);
        echo ("<script LANGUAGE='JavaScript'> window.alert('Vehicle Updated'); window.location.href='managevehicle.php'; </script>");
    }
    if (!isset($_GET['edit'])) {
        if (!empty($vehicle_name) && !empty($vehicle_number) && !empty($model) && !empty($transmission) && !empty($fuel_type) && !empty($rent_amount)) {
            $query = "INSERT INTO vehicle (vehicle_name,vehi_number,model,transmission,fuel_type,amount) VALUES ('$vehicle_name','$vehicle_number','$model','$transmission','$fuel_type','$rent_amount')";
            mysqli_query($conn, $query);
            echo ("<script LANGUAGE='JavaScript'> window.alert('Vehicle Added'); window.location.href='managevehicle.php'; </script>");
        } else {
            echo ("<script LANGUAGE='JavaScript'> window.alert('Please Enter Valid Information'); </script>");
        }
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_GET['edit'])) {
        $query = "SELECT * FROM vehicle WHERE id = '$id' LIMIT 1";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $vehicle_name = $row['vehicle_name'];
        $vehicle_number = $row['vehi_number'];
        $model = $row['model'];
        $transmission = $row['transmission'];
        $fuel_type = $row['fuel_type'];
        $rent_amount = $row['amount'];
    }
    if (isset($_GET['delete'])) {
        $query = "DELETE FROM vehicle WHERE id = '$id'";
        if (mysqli_query($conn, $query)) {
            echo ("<script LANGUAGE='JavaScript'> window.alert('Vehicle Deleted'); window.location.href='managevehicle.php'; </script>");
        }
        ;
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Cab Rental Service - Manage Vehicle</title>
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

        h2 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: inline-block;
            width: 250px;
            font-weight: bold;
        }

        .form-group input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            width: 400px;
        }

        .btn-container {
            text-align: left;
            margin-top: 20px;
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
            font-size: 18px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .btn-cancel {
            background-color: #f44336;
        }

        .btn:hover,
        .btn-cancel:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if (isset($_GET['edit'])) {
            echo "<h2>Edit Vehicle</h2>";
        } else {
            echo "<h2>Add New Vehicle</h2>";
        }
        ?>
        <form method=POST>
            <div class="form-group">
                <?php if (isset($_GET['edit'])) {
                    echo "<input type='hidden' name='id' value=" . $id . ">";
                } ?>
                <label for="vehicle-name">Vehicle Name:</label>
                <input type="text" id="vehicle-name" name="vehicle_name" value="<?php if (isset($_GET['edit'])) {
                    echo $vehicle_name;
                } ?>" required>
            </div>
            <div class="form-group">
                <label for="vehicle-number">Vehicle Number:</label>
                <input type="text" id="vehicle-number" name="vehicle_number" value="<?php if (isset($_GET['edit'])) {
                    echo $vehicle_number;
                } ?>" required>
            </div>
            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" id="model" name="model" value="<?php if (isset($_GET['edit'])) {
                    echo $model;
                } ?>" required>
            </div>
            <div class="form-group">
                <label for="transmission">Transmission:</label>
                <input type="text" id="transmission" name="transmission" value="<?php if (isset($_GET['edit'])) {
                    echo $transmission;
                } ?>" required>
            </div>
            <div class="form-group">
                <label for="fuel-type">Fuel Type:</label>
                <input type="text" id="fuel-type" name="fuel_type" value="<?php if (isset($_GET['edit'])) {
                    echo $fuel_type;
                } ?>" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="text" id="amount" name="rent_amount" value="<?php if (isset($_GET['edit'])) {
                    echo $rent_amount;
                } ?>" required>
            </div>
            <div class='btn-container'>
                <?php if (isset($_GET['edit'])) {
                    echo "<button class='btn'>Edit Vehicle</button>";
                } else {
                    echo "<button class='btn'>Add Vehicle</button>";
                }
                ?>
                <a href="managevehicle.php" class='btn btn-cancel'>Cancel</a>
        </form>
    </div>
</body>

</html>