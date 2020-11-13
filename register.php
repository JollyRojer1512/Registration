<?
// ==========================
function register($name, $surname, $email, $password){
    $database = false;

    if(!$database){
        $fd = fopen("accounts.txt", 'a') or die("не удалось создать файл");
        fwrite($fd, $email);
        fwrite($fd, $password);
        fwrite($fd, $name);
        fwrite($fd, $surname);
        fwrite($fd, "\n");
        fclose($fd);
    }
    else{

        
        $pdo = new PDO('mysql:host=localhost; dbname=exercise;', 'root', 'root');
    $sql = "INSERT INTO users (name, surname, email, password) VALUES (:name, :surname, :email, :password)";
    $query = $pdo->prepare($sql);
    $query->bindParam(':name', $name);
    $query->bindParam(':surname', $surname);
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password);
    $query->execute();   
    }
}
?>