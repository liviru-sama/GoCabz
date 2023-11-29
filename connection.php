<?php

$dbhost = "localhost";
$dbuser = "cabadmin";
$dbpass = "cabadmin";
$dbname = "gocabz";

if (!$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
	die("failed to connect!");
}
?>