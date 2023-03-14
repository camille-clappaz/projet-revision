<?php
session_start();
$username = "root";
$password = "";
try {
    $bd = new PDO("mysql:host=localhost;dbname=révisions;charset=utf8mb4", $username, $password);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully" . "<br>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
function addArticle($article, $bd)
{
    
    $addArticle = $bd->prepare("INSERT INTO `articles`(`article`, `id_utilisateurs`) VALUES (?,?)");
    // var_dump($addArticle);
    $addArticle->execute([$article, $_SESSION['id']]);
    // var_dump($addArticle);
}
// var_dump($_SESSION);

?>
<?php if (isset($_POST['submit'])) : ?>
    <?php addArticle($_POST['article'], $bd); ?>
<?php endif ?>
<form action="" method="post">
    <input type="text" name="article">
    <button type="submit" name="submit">Add article</button>
</form>