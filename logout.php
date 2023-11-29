<?php

session_start();

if (isset($_SESSION['id'])) {
    unset($_SESSION['id']);
    unset($_SESSION['type']);

}
echo ("<script LANGUAGE='JavaScript'>
    window.alert('Do you need to Logout?');
    window.location.href='index.php';
    </script>");

//header("Location: Login.php");
die;