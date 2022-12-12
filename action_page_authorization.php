<?php

session_start();
$servername = "localhost";
$database = "testing system";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
    
}


$login = 0;
$password = 0;

if(isset($_POST["login"])){
  
    $login = $_POST["login"];

if(isset($_POST["password"])){
  
    $password = $_POST["password"];

    $sql = mysqli_query($conn, "SELECT password FROM `users` WHERE (login = '$login')");
    $row = mysqli_fetch_array($sql);
    if ($password == $row[0]) {
        $sql2 = mysqli_query($conn, "SELECT id_user FROM `users` WHERE (login = '$login')");
        $id_user = mysqli_fetch_array($sql2);
        setcookie("identification", $id_user[0], time() + 7200);
        header('Location: http://localhost/index.php');
    } 
    else {
        echo 'ERROR authorization';
    }
}}


?>



