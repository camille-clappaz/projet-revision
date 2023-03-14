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

function displayUser($bd, $order)
{
    $order = "";
    $displayUser = $bd->prepare("SELECT utilisateurs.login, articles.article FROM `utilisateurs` INNER JOIN `articles` ON id_utilisateur = utilisateurs.id ORDER BY articles.id $order");
    $displayUser->execute();
    $result = $displayUser->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    // IMPORTANT si je ne retourne pas le résultat, je ne pourrai pas utiliser mon $result ailleurs.
}
// var_dump(displayUser($bd));

if (isset($_GET['inverser'])) {
    if ($order = "DESC") {
        $order = "ASC";
        displayUser($bd,$order);
    
    } else {
        $order = "DESC";
        displayUser($bd,$order);
    }
} else {
    $order = "DESC";
    displayUser($bd,$order);
}
var_dump($order);
?>
<table>

    <?php
    $result = displayUser($bd, $order); ?>
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
<button type="submit" name="inverser"> Inverser</button>
</form>