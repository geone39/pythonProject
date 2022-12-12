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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
    <style>
        textarea {width: 300px;height: 300px;width: 100%;padding: 15px;margin: 5px 0 22px 0;display: inline-block;border: none;background: #f1f1f1;}
        .btn{margin-top: 30px;margin-bottom: 30px;}
body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: white;
}
        form {width: 600px;
        margin-left:auto;
        margin-right: auto;}
* {
    box-sizing: border-box;
}

/* Add padding to containers */
.container {
    padding: 16px;
    background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

/* Overwrite default styles of hr */
hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

.registerbtn:hover {
    opacity: 1;
}

/* Add a blue text color to links */
a {
    color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
    background-color: #f1f1f1;
    text-align: center;
}
</style>
</head>
<body>
  <form method="POST" action="upload_task.php">
    <hr>
    <a href="index.php" type="button" class="btn btn-primary">На главную</a><br><br>    
    <p>Примечание: Для того чтобы создать новую задачу отправьте данные в блоке "Новая задача". Для того чтобы загрузить тесты, отправьте данные в блоке "Добавление тестов". Перед тем как добавить тесты, необходимо сначала добавить саму задачу.</p>
    <h1>Новая задача</h1>  
      <label for="name_task"><b>Название задачи</b></label>
    <input type="text" placeholder="Название задачи" name="name_task" required>
    <label for="text"><b>Текст задачи</b></label>
    <textarea type="text" placeholder="Текст задачи" name="text"></textarea>
    <label for="input_text"><b>Пример входных данных</b></label>
    <input type="text" placeholder="Пример входных данных" name="input_text" required>
    <label for="output_text"><b>Пример выходных данных</b></label>
    <input type="text" placeholder="Пример выходных данных" name="output_text" required>
    
    <input type="submit" name="uploadBtn" class="registerbtn" value="Готово" /><hr>
    <hr>
  </form>
    <form method="POST" action="upload_tests.php" enctype="multipart/form-data">
    <?
    $sql = mysqli_query($conn, 'SELECT `id_task` FROM `task`');
    while($row = mysqli_fetch_array($sql)){
    $id_task=$row['id_task'];
    }
    echo "ID последней добавленной задачи: $id_task";
    ?>
    <hr>
    <h1>Добавление тестов</h1>  
    <label for="id_task"><b>ID Задачи</b></label>
    <input type="text" placeholder="ID Задачи" name="id_task" required>
            <input type="file" name="input">
            <label for="file" class="btn btn-tertiary js-labelFile">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName">Загрузить файл Input</span>
            </label>
            <input type="file" name="output">
            <label for="file" class="btn btn-tertiary js-labelFile">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName">Загрузить файл Output</span>
            </label>
    <input type="submit" name="uploadBtn" class="registerbtn" value="Готово" /><hr>
    <hr>
  </form>
    
</body>
</html>