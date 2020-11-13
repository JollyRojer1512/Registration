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
<?
// $users = getAllUsers()
if(count($_POST) > 0){
	$name = $_POST['name'].$k." ";
	$surname = $_POST['surname'].$k." ";
	$email = $_POST['email'].$k." ";
	$password = $_POST['password'].$k." ";
	register($name, $surname, $email, $password);
	// header('Location: /');
	// die;
}

?>
<form class="container" method="post">
    <input type="text" placeholder="Name" name="name">
    <input type="text" placeholder="Surname" name="surname">
    <input type="email" placeholder="E-mail" name="email">
    <input type="password" placeholder="Password" name="password">
    <!-- <input type="submit" placeholder="Register"> -->
    <button type="submit">Register</button>
</form>

</body>
</html>