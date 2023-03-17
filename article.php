<?php
session_start();
include("bd.php");
function addArticle($article, $bd)
{

    $addArticle = $bd->prepare("INSERT INTO `articles`(`article`, `id_utilisateur`) VALUES (?,?)");
    // var_dump($addArticle);
    $addArticle->execute([$article, $_SESSION['id']]);
    // var_dump($addArticle);
}
// function addCategorie($categorie, $bd){
//     $addCategorie = $bd->prepare("INSERT INTO `categories`(`categorie`) VALUES (?), 'articles'('article') VALUES (?) SELECT categories.categorie, articles.article FROM liaison JOIN articles ON articles.id=id_article JOIN categories ON categories.id=id_categorie ");
//     var_dump($addCategorie);
//     $addCategorie->execute([$_POST['categorie']]);
// }

var_dump($_SESSION);

?>
<?php if (isset($_POST['submit'])) : ?>
    <?php addArticle($_POST['article'], $bd) ?>
<?php endif ?>

<form action="" method="post">
    <input type="text" name="article"><br>
    <?php //afficher la base de donnée
    $afficheCategorie = $bd->prepare("SELECT * FROM categories");
    $afficheCategorie->execute();
    $result = $afficheCategorie->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $key => $value) { ?>
        <input type="checkbox" name="categorie[]" value="<?= $value["id"] ?>">
        <label><?= $value["name"] ?></label></br>
    <?php }
    ?>
    <button type="submit" name="submit">Add article</button>
</form>