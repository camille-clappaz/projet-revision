<?php
require('User.php');


if (isset($_POST["submit"])) :
    $user = new User($_POST['login'], 'test', 'test', 'test', $_POST['password']); ?>

    <form action='' method='post'>
        <input type='text' name='login'>
        <input type='text' name='password'>
        <button type='submit' name='submit'>Connexion</button><br>
        <?= $user->connect($_POST['login'], $_POST['password']); ?>
    </form>
<?php endif ?>
<?php $user->isConnected();

var_dump($_SESSION);
?>