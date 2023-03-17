<?php
include("bd.php");
require('User.php');
// $username = "root";
// $password = "";
// try {
//     $bd = new PDO("mysql:host=localhost;dbname=révisions;charset=utf8mb4", $username, $password);
//     $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "Connected successfully";
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }
// Pas besoin de réecrire la connexion à la bd, car elle est dans le construct de la class User

?>

<form action="" method="post">
    <input type="text" name="login" placeholder="login"><br>
    <input type="text" name="firstname" placeholder="firstname"><br>
    <input type="text" name="lastname" placeholder="lastname"><br>
    <input type="text" name="email" placeholder="email"><br>
    <input type="text" name="password" placeholder="password"><br>
    <input type="text" name="confirm_password" placeholder="confirm_password"><br>
    <button type="submit" name="submit">S'inscrire</button>


</form>
<?php
if (isset($_POST['submit'])) {
    if ($_POST["password"] == $_POST["confirm_password"]) {
        $user = new user("$_POST[login]", "$_POST[firstname]", "$_POST[lastname]", "$_POST[email]", "$_POST[password]");
        $user->register($bd);
        }
       
    else{
        echo "Les mots de passe ne sont pas identiques!";
    }}

?>