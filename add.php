<?session_start(); //Запускаем сессии?>
<?require 'functions.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header">
    <div class="logo">Exercise</div>
    <!-- <div class="slogan">Exercise is a platform to learn and prepare to exams</div> -->
    <div class="authorisation">

<?
$auth = new AuthClass();
if(isset($_POST['logout'])) { 
    $auth->out();
} 
 
    // $auth->logout();
?>
        <form method="post" class="login">
<?
    if($auth->authorize()):
?>
        <h2 style='color:red; font-size:10px;'>Логин и пароль введен не правильно!</h2>
<?
endif;
    if ($auth->isAuth()): // Если пользователь авторизован, приветствуем:  
?>
        <h4>Good day, <?=$auth->getLogin();?></h4><br>
         <br/><br/><input type='submit' name='logout' value='Log out'/> <!-- Показываем кнопку выхода -->
<?

    else: //Если не авторизован, показываем форму ввода логина и пароля
?>
                <input type="email" placeholder="E-mail" name="email" value="<?php echo (isset($_POST["email"])) ? $_POST["email"] : null; // Заполняем поле по умолчанию ?>" />
                <input type="password" placeholder="Password" name="password">
                <input type="submit" value="Log in" name="login">
                <a href='registration.php'>Register</a>
<?endif;?>
        </form>
                    
                </div>
        </div>
</header>