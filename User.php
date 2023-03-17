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
    }
    public function register($bd)
    {
        if ($this->loginUnique($bd)) {
            if ($this->emailUnique($bd)) {
                if ($this->isEmpty()) {
                    $addUser = $bd->prepare("INSERT INTO `utilisateurs`(`login`, `password`, `email`, `firstname`, `lastname`) VALUES (?,?,?,?,?) ");
                    $addUser->execute([$this->login, $this->password, $this->email, $this->firstname, $this->lastname]);
                    header("Location:connexion.php");
                }
            } else {
                echo " L'email existe déjà";
            }
        } else {
            echo " Le login existe déjà";
        }
    }
    public function loginUnique($bd)
    { // Vérifie que le login est bien unique
        $findLogin = $bd->prepare("SELECT `login` FROM `utilisateurs` WHERE login=?");
        $findLogin->execute([$_POST['login']]);
        if ($findLogin->rowCount() < 1) {
            return true;
        } else {
            return false;
        }
    }
    public function emailUnique($bd)
    { // Vérifie que l'email' est bien unique
        $findemail = $bd->prepare("SELECT `email` FROM `utilisateurs` WHERE email=?");
        $findemail->execute([$_POST['email']]);
        if ($findemail->rowCount() < 1) {
            return true;
        } else {
            return false;
        }
    }
    public function isEmpty()
    {
        if (!empty($_POST['login']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
            return true;
        } else {
            echo "Il faut remplir tout les champs";
            return false;
        }
    }

    public function update($login, $firstname, $lastname, $email, $password, $bd)
    {
        $updateUser = $bd->prepare("UPDATE `utilisateurs` SET `login`=?,`password`=?,`email`=?,`firstname`=?,`lastname`=? WHERE id=?");
        //mise à jour des attributs
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        // $this->setlogin($login);
        $updateUser->execute([
            $this->login, $this->password, $this->email, $this->firstname, $this->lastname,
            //mise à jour de la session :
            $_SESSION['id']
        ]);
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;
        $_SESSION['email'] = $email;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
    }
    public function connect($login, $password, $bd)
    {
        $connect = $bd->prepare("SELECT * from utilisateurs WHERE login=? AND password=?");
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
        $this->login = $login;
    }
    public function getpassword()
    {
        return $this->password;
    }
    public function setpassword($password)
    {
        $this->password = $password;
    }
    public function getemail()
    {
        return $this->email;
    }
    public function setemail($email)
    {
        $this->email = $email;
    }
    public function getfirstname()
    {
        return $this->firstname;
    }
    public function setfirstname($firstname)
    {
        $this->firstname = $firstname;
    }
    public function getlasttname()
    {
        return $this->lastname;
    }
    public function setlastname($lastname)
    {
        $this->lastname = $lastname;
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
