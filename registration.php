<?php
header('Content-Type: text/html; charset= utf-8');
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: white;
}

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

<form action="action_page_registration.php" method="POST">
  <div class="container">
    <h1>Регистрация</h1>
    <p>Заполните данные чтобы зарегестрироватся на сайте и продоложить работу.</p>
    <hr>

    <label for="login"><b>Логин</b></label>
    <input type="text" placeholder="Введите логин" name="login" required>

    <label for="name"><b>Имя</b></label>
    <input type="text" placeholder="Введите имя" name="name" required>
      
    <label for="surname"><b>Фамилия</b></label>
    <input type="text" placeholder="Введите фамилию" name="surname" required>

    <label for="password"><b>Пароль</b></label>
    <input type="password" placeholder="Введите пароль" name="password" required>

    <label for="password_repeat"><b>Повторите пароль</b></label>
    <input type="password" placeholder="Введите пароль" name="password_repeat" required>
    <hr>
    <p>Создавая учетную запись, вы соглашаетесь с нашими <a href="/privacy.pdf">политика конфиденциальности и условия использования</a>.</p>

    <button type="submit" class="registerbtn">Регистрация</button>
  </div>
  
  <div class="container signin">
    <p>Уже есть аккаунт? <a href="authorization.php">Войти</a>.</p>
  </div>
</form>

</body>
</html>



