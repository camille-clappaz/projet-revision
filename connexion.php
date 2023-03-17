<?php
include("bd.php");
require('User.php');

if (isset($_POST["connexion"])) {
    $user = new User($_POST['login'], '', '', '', $_POST['password']);
    $user->connect($_POST['login'], $_POST['password'],$bd);
    $user->isConnected();

}


// var_dump($_SESSION);
?>

<form action='' method='post'>
    <input type='text' name='login' placeholder="login">
    <input type='text' name='password' placeholder="password">
    <button type='submit' name='connexion'>Connexion</button><br>
</form>
