<?php 
require('User.php');

if(isset($_POST['modifier'])){
    $user = new user($_POST['login'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password']);
    $user->update($_POST['login'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password']);
    
}

?>
<form action="" method="post">
    <input type="text" name="login" value=<?=$_SESSION['login']?>>
    <input type="text" name="firstname" value=<?=$_SESSION['firstname']?>>
    <input type="text" name="lastname" value=<?=$_SESSION['lastname']?>>
    <input type="text" name="email" value=<?=$_SESSION['email']?>>
    <input type="text" name="password" value=<?=$_SESSION['password']?>>
    <input type="text" name="confirm_password" value=<?=$_SESSION['password']?>>
    <button type="submit" name="modifier">Modifier</button>
    <?php header('refresh');?>

</form>