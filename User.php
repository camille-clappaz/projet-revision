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
    // public function update($login, $firstname, $lastname, $email, $password)
    // {
    //     $updateUser = $this->bd->prepare("UPDATE `utilisateurs` SET `login`=:login,`password`=:password,`email`=:email,`firstname`=:firstname,`lastname`=:lastname WHERE id=:id");
    //     $data = ['login' => $this->login,'password' => $this->password,'email' => $this->email,'firstname' => $this->firstname,'lastname' => $this->lastname,'id' => $_SESSION['id']];
    //     $updateUser->execute($data);
    //     $_SESSION=$data;
    // }
    public function update($login, $firstname, $lastname, $email, $password)
    {
        $updateUser = $this->bd->prepare("UPDATE `utilisateurs` SET `login`=?,`password`=?,`email`=?,`firstname`=?,`lastname`=? WHERE id=?");
        //mise à jour des attributs
        $this->login=$login;  $this->password=$password; $this->email=$email; $this->firstname=$firstname; $this->lastname=$lastname;
        // $this->setlogin($login);
        $updateUser->execute([$this->login, $this->password, $this->email, $this->firstname, $this->lastname, 
        //mise à jour de la session :
        $_SESSION['id']]);
        $_SESSION['login']=$login;
        $_SESSION['password']=$password;
        $_SESSION['email']=$email;
        $_SESSION['firstname']=$firstname;
        $_SESSION['lastname']=$lastname;        
    }
    public function connect($login,$password)
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
       return $this->login; 

    }
    public function setlogin($login)
    {
        $this->login=$login; 
    }
    public function getpassword()
    {return $this->login;
    }
    public function setpassword($password)
    {
    }
    public function getemail()
    {return $this->login;
    }
    public function setemail($email)
    {
    }
    public function getfirstname()
    {return $this->login;
    }
    public function setfirstname($firstname)
    {
    }
    public function getlasttname()
    {return $this->login;
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
