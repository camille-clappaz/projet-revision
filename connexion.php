<?php 
require('User.php');
// session_start();

if(isset($_POST["submit"])){
    $user=new User($_POST['login'], 'test', 'test', 'test', $_POST['password']);
    $user->connect($_POST['login'], $_POST['password']);
}
var_dump($_SESSION);
?>
<form action="" method="post">
    <input type="text" name="login">
    <input type="text" name="password">
    <button type="submit" name="submit">Connexion</button>
</form>