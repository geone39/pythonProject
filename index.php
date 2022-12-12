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
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div style="width: 900px; margin:auto; margin-top:50px; ">
        <? if ($_COOKIE['identification'] == '1') {
    echo '<a href="add.php" type="button" class="btn btn-primary">Добавить задачу</a>';
           }
    ?>
        <a href="exit.php" type="button" class="btn btn-primary">Выйти</a>
    </div>
    <div style="width: 900px; padding:50px; margin:auto;">
    
    <h2>Задачи</h2>
    <?php
    echo "<table border='0'>
   <tr>
    <th style='width: 200px;text-align: center;'>ID Задачи</th>
    <th style='width: 500px;text-align: center;'>Название задачи</th>
    <th style='width: 200px;text-align: center;'>Ссылка</th>
   </tr><hr>";
    $sql = mysqli_query($conn, 'SELECT `id_task`, `name_task` FROM `task`');
    while($row = mysqli_fetch_array($sql)){
    $id_task=$row['id_task'];
    $name_task=$row['name_task'];
    $sslka = 'testing/' . $id_task . '/' . $id_task . '.php';
    echo "<tr><td style='text-align: center;'>$id_task</td><td style='text-align: center;'>$name_task</td><td style='text-align: center;'><a href='$sslka'>перейти</a></td></tr>";
    }
    echo "</table><hr>";
    
    ?>
    </div>
</body>
</html>