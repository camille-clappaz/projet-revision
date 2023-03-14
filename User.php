<?php
session_start();

class User
{
    private $id;
    public $login;
    private $password;
    public $email;
    public $firstname;
    public $lastname;
    public $bd;

    public function __construct(
        $login,
        $email,
        $firstname,
        $lastname,
        $password,

    ) {
        $this->login = $login;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->password = $password;
        $username = "root";
        $password = "";
        try {
            $this->bd = new PDO("mysql:host=localhost;dbname=révisions;charset=utf8mb4", $username, $password);
            $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully" . "<br>";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function register()
    {
        $addUser = $this->bd->prepare("INSERT INTO `utilisateurs`(`login`, `password`, `email`, `firstname`, `lastname`) VALUES (?,?,?,?,?) ");
        $addUser->execute([$this->login, $this->password, $this->email, $this->firstname, $this->lastname]);
    }
    public function update()
    {
        $updateUser = $this->bd->prepare("UPDATE `utilisateurs` SET `login`=?,`password`=?,`email`=?,`firstname`=?,`lastname`=? WHERE login=?");
        $updateUser->execute([$this->login, $this->password, $this->email, $this->firstname, $this->lastname]);
    }
    public function connect()
    {
        $connect = $this->bd->prepare("SELECT * from utilisateurs WHERE login=? AND password=?");
        $connect->execute([$this->login, $this->password]);
        $result = $connect->fetchAll(PDO::FETCH_ASSOC);
        $count = $connect->rowCount();
        if ($count == 0) {
            $message = "votre login ou mdp est incorrect";
        } else {
            $_SESSION = $result[0];

            $message = "vous etes connecté";
        }
        echo $message;
    }
    public function disconnect()
    {
        session_destroy();
    }
    public function isConnected()
    {
        if (empty($_SESSION)) {
            echo "false";
            return false;
            
        } else {
            echo "true";
            return true;
        
        }
    }
  
    public function getlogin()
    {
        $getLog = $this->bd->prepare("SELECT utilisateurs.login FROM utilisateurs WHERE login = ?");
        $getLog->execute([$this->login]);
        $result = $getLog->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result[0]['login']);
        return $result[0]['login'];

    }
    public function setlogin($login)
    {
        $setLog = $this->bd->prepare("INSERT INTO 'utilisateurs'('login') VALUES ($login)");
        $setLog->execute([$this->login]);
        $result = $setLog->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result['login']);
        return $result['login'];
    }
    public function getpassword()
    {
    }
    public function setpassword($password)
    {
    }
    public function getemail()
    {
    }
    public function setemail($email)
    {
    }
    public function getfirstname()
    {
    }
    public function setfirstname($firstname)
    {
    }
    public function getlasttname()
    {
    }
    public function setlastname($lastname)
    {
    }
}
// $user = new User('test', 'test', 'test', 'test', 'test');
// $user->getlogin();
// var_dump($_SESSION);
// $user->setlogin("ed");
// $user->register();
// $user->connect();
// $user->disconnect();
// $user->isConnected();
