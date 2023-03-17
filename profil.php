<?php 
include("bd.php");
require('User.php');

if(isset($_POST['modifier'])){
    $user = new user($_POST['login'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password']);
    $user->update($_POST['login'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'],$bd);
    
}

?>
<form action="" method="post">
    <label for="login">Login:</label><br>
    <input type="text" name="login" value=<?=$_SESSION['login']?>><br>
    <label for="login">Firstname:</label><br>
    <input type="text" name="firstname"  value=<?=$_SESSION['firstname']?>><br>
    <label for="login">Lastname:</label><br>
    <input type="text" name="lastname"  value=<?=$_SESSION['lastname']?>><br>
    <label for="login">Email:</label><br>
    <input type="text" name="email"  value=<?=$_SESSION['email']?>><br>
    <label for="login">Password:</label><br>
    <input type="text" name="password" value=<?=$_SESSION['password']?>><br>
    <label for="login">Confirm_password:</label><br>
    <input type="text" name="confirm_password"  value=<?=$_SESSION['password']?>><br>
    <button type="submit" name="modifier">Modifier</button>
     <?php header('refresh');?>

</form>