<?php
session_start();
header('Content-Type: text/html; charset= utf-8');
$servername = "localhost";
$database = "testing system";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
    echo "ERROR";
}
if (!isset($_COOKIE['identification'])) {
    header('Location: http://localhost/authorization.php');
    exit();
}
        
    setcookie("identification", $id_user[0], time() - 7200);
    header('Location: http://localhost/authorization.php');
?>