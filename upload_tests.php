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

$id_task = 0;
$text = 0;
$input_text = 0;
$output_text = 0;


    
if(isset($_POST["id_task"])){
  
    $id_task = $_POST["id_task"];
    $sql = mysqli_query($conn, "SELECT id_task FROM `task` WHERE (id_task = '$id_task')");
    $row = mysqli_fetch_array($sql);
    $nubmer_task = $row[0];
    $sql2 = mysqli_query($conn, "SELECT count_test FROM `task` WHERE (id_task = '$id_task')");
    $row2 = mysqli_fetch_array($sql2);
    $count_test = $row2[0];
    
    
    $fileTmpPath_input = $_FILES['input']['tmp_name'];
    $fileName_input = $_FILES['input']['name'];
    $fileSize_input = $_FILES['input']['size'];
    $fileType_input = $_FILES['input']['type'];
    $fileNameCmps_input = explode(".", $fileName_input);
    $fileExtension_input = strtolower(end($fileNameCmps_input));
    $uploadFileDir_input = './testing/'.$nubmer_task.'/';
    $newFileName_input = 'input' . $count_test . '.' . $fileExtension_input;
    $dest_path_input = $uploadFileDir_input .  $newFileName_input;
    
    $fileTmpPath_output = $_FILES['output']['tmp_name'];
    $fileName_output = $_FILES['output']['name'];
    $fileSize_output = $_FILES['output']['size'];
    $fileType_output = $_FILES['output']['type'];
    $fileNameCmps_output = explode(".", $fileName_output);
    $fileExtension_output = strtolower(end($fileNameCmps_output));
    $uploadFileDir_output = './testing/'.$nubmer_task.'/';
    $newFileName_output = 'output' . $count_test . '.' . $fileExtension_output;
    $dest_path_output = $uploadFileDir_output .  $newFileName_output;
    
    $count_test = $count_test + 1;
    $sql3 = mysqli_query($conn, "UPDATE `task` SET `count_test`='$count_test' WHERE (id_task = '$id_task')");
    
    move_uploaded_file($fileTmpPath_input, $dest_path_input);
    move_uploaded_file($fileTmpPath_output, $dest_path_output);
}
    header('Location: http://localhost/add.php');
?>