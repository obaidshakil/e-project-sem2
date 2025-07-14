<?php
ob_start();
session_start();
include('function.php');

$host = "localhost";
$username = "root";
$password = "";
$dbname = "sound_entertainment";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>