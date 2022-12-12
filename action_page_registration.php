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
$name = 0;
$surname = 0;
$password = 0;
$password_repeat = 0;

if(isset($_POST["login"])){
  
    $login = $_POST["login"];
}
if(isset($_POST["name"])){
  
    $name = $_POST["name"];
}
if(isset($_POST["surname"])){
  
    $surname = $_POST["surname"];
}
if(isset($_POST["password"])){
  
    $password = $_POST["password"];
}
if(isset($_POST["password_repeat"])){
  
    $password_repeat = $_POST["password_repeat"];
}
    if ($password == $password_repeat) {
        $sql = mysqli_query($conn, "INSERT INTO `users`(`login`, `name`, `surname`, `password`) VALUES ('$login', '$name', '$surname', '$password')");
        header('Location: http://localhost/index.php');
        
    }
    else {
        echo 'ERROR registration';
    }

?>