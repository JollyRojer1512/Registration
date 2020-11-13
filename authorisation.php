<?
// ==========================
// session_start(); //Запускаем сессии
 
/** 
 * Класс для авторизации
 *
 */ 
class AuthClass {
    private $_email; //Устанавливаем логин
    private $_password; //Устанавливаем пароль
 
    public function authorize(){
        if (isset($_POST["email"]) && isset($_POST["password"])) { //Если логин и пароль были отправлены
            if (!$this->auth($_POST["email"], $_POST["password"])) { //Если логин и пароль введен не правильно
                return true;
            }
        }
    }

    /**
     * Проверяет, авторизован пользователь или нет
     * Возвращает true если авторизован, иначе false
     * return boolean 
     */
    public function isAuth() {
        if (isset($_SESSION["is_auth"])) { //Если сессия существует
            return $_SESSION["is_auth"]; //Возвращаем значение переменной сессии is_auth (хранит true если авторизован, false если не авторизован)
        }
        else return false; //Пользователь не авторизован, т.к. переменная is_auth не создана
    }
     
    /**
     * Авторизация пользователя
     * param string $login
     * param string $passwors 
     */
    private function auth($email, $password) {
        if ($this->login($email, $password)) { //Если логин и пароль введены правильно
            $_SESSION["is_auth"] = true; //Делаем пользователя авторизованным
            $_SESSION["email"] = $email; //Записываем в сессию логин пользователя
            return true;
        }
        else { //Логин и пароль не подошел
            $_SESSION["is_auth"] = false;
            return false; 
        }
	}
	
	private function login($email, $password){
        $database = false;
        $user = false;
        // echo $email;

        if(!$database){
            $fd = fopen("accounts.txt", 'r') or die("не удалось открыть файл");
            while(!feof($fd))
            {
                $str = htmlentities(fgets($fd));
                $arr = explode(' ', $str);
                // echo $arr[1];
                if(feof($fd)) break;
                if($email == $arr[0] && $password == $arr[1]){
                    $user = true;
                }
            }
            fclose($fd);

        }
        else{
            $pdo = new PDO('mysql:host=localhost; dbname=exercise;', 'root', 'root');
            $sql = "SELECT * FROM users WHERE email=:email AND password=:password";
		$query = $pdo->prepare($sql);
		$query->bindParam(':email', $email);
		$query->bindParam(':password', $password);
		$query->execute();   
		$user = $query->fetch(PDO::FETCH_ASSOC);
		// var_dump($user);
    }
		if($user){
            $_SESSION['user'] = $user;
			return true;
		}
		return false;
	}
     
    /**
     * Метод возвращает логин авторизованного пользователя 
     */
    public function getLogin() {
        if ($this->isAuth()) { //Если пользователь авторизован
            return $_SESSION["email"]; //Возвращаем email, который записан в сессию
        }
    }
     
     
    public function out() {
        $_SESSION = array(); //Очищаем сессию
		session_destroy(); //Уничтожаем
    }
}
 
?>