<?php
session_start();
include("bd.php");

function displayUser($bd, $order)
{
    $displayUser = $bd->prepare("SELECT utilisateurs.login, articles.article FROM `utilisateurs` INNER JOIN `articles` ON id_utilisateur = utilisateurs.id ORDER BY articles.id $order");
    $displayUser->execute();
    $result = $displayUser->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    // IMPORTANT si je ne retourne pas le résultat, je ne pourrai pas utiliser mon $result ailleurs.
}
// var_dump(displayUser($bd));

if (isset($_GET['inverser'])) { 
    if ($_GET['inverser'] == "DESC") { // si on c'est DESC transformer en ASC
        $order = "ASC";
        displayUser($bd, $order);
    } else { // si c'est en ASC transformer en DESC
        $order = "DESC";
        displayUser($bd, $order);
    }
} else { // si on ne touche pas au bouton inverser, l'ordre est DESC 
    $order = "DESC";
    displayUser($bd, $order);
}
var_dump($order);
?>
<table>

    <?php
    $result = displayUser($bd, $order);
    ?>
    <form action="" method="get">
        <?php for ($i = 0; $i < count($result); $i++) :
        ?>
            <tr>
                <td> Ecrit par <?= $result[$i]['login']
                                ?></td>
                <td>: <?= $result[$i]['article']
                        ?></td>
            </tr>
        <?php endfor ?>


</table>
<button type="submit" name="inverser" value=<?= $order ?>> Inverser</button>
</form>