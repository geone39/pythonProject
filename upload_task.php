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


$name_task = 0;
$text = 0;
$input_text = 0;
$output_text = 0;

if(isset($_POST["name_task"])){
  
    $name_task = $_POST["name_task"];

if(isset($_POST["text"])){
  
    $text = $_POST["text"];

if(isset($_POST["input_text"])){
  
    $input_text = $_POST["input_text"];

if(isset($_POST["output_text"])){
  
    $output_text = $_POST["output_text"];

    $sql = mysqli_query($conn, "INSERT INTO `task`(`name_task`, `text`, `input_text`, `output_text`, `count_test`) VALUES ('$name_task', '$text', '$input_text', '$output_text', 1)");
    $sql2 = mysqli_query($conn, "SELECT id_task FROM `task` WHERE (text = '$text')");
    $row = mysqli_fetch_array($sql2);
    $link_page = $row[0].'/'.$row[0].'.php';
    $link_dir = $row[0];
    chdir('testing');
    mkdir($link_dir, 0777, true);
    $f = fopen($link_page, "w");
    chdir('../');
    $str_new_page = file_get_contents('task.txt');
    fwrite($f, $str_new_page); 
    fclose($f);  
}}}} 
    
    header('Location: http://localhost/add.php');
?>