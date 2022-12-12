<?php
session_start();
$servername = "localhost";
$database = "testing system";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
    echo "ERROR";
}

$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}

$_id_task = $_POST['id_task'];
$_id_user = $_POST['id_user'];
$fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
$fileName = $_FILES['uploadedFile']['name'];
$fileSize = $_FILES['uploadedFile']['size'];
$fileType = $_FILES['uploadedFile']['type'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));
$random_name_file = generate_string($permitted_chars, 20);
$uploadFileDir = './download/';
$newFileName = $random_name_file . '.' . $fileExtension;
$dest_path = $uploadFileDir .  $newFileName;
$str_to_values = $random_name_file . '.py testing/' . $_id_task;
file_put_contents('values.txt', $str_to_values);
if(move_uploaded_file($fileTmpPath, $dest_path))
{
  $message ='File is successfully uploaded.';
  $message = exec("test.py");
  if ($message == 'OK') {
      
    $command = escapeshellcmd('Z:\home\localhost\www\test.py');
    $output = shell_exec($command);
    $pathToFile = 'result.txt';
    if (file_exists($pathToFile)) {
        $GetContentFile = file_get_contents($pathToFile);
    }
     
    $sql2 = mysqli_query($conn, "SELECT COUNT(*) as count FROM `score` WHERE (id_user = '$_id_user' AND id_task = '$_id_task')");
    $row2 = mysqli_fetch_array($sql2);
    $count_sending = $row2[0];
    $count_sending = $count_sending + 1;
    $sql ="INSERT INTO `score` (`id_user`, `id_task`, `score`, `count_sending`) VALUES ('$_id_user', '$_id_task','$GetContentFile','$count_sending')";
    if (mysqli_query($conn, $sql)) {
	      $_SESSION['flagUploadedFile'] = 'OK';
	} else {
	      $_SESSION['flagUploadedFile'] = $sql . "<br>" . mysqli_error($conn);
	}
      
  }
}
else
{
  $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
}
$newURL = 'http://localhost/testing/'.$_id_task.'/'.$_id_task.'.php';
header('Location: '.$newURL);
#https://code.tutsplus.com/ru/tutorials/how-to-upload-a-file-in-php-with-example--cms-31763
#INSERT INTO `testing system`.`test` (`id`, `score`, `code`) VALUES (NULL, '1', '1');
?>