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

function displayUser($bd)
{
    $displayUser = $bd->prepare("SELECT utilisateurs.login, articles.article FROM `utilisateurs` INNER JOIN `articles` ON id_utilisateur = utilisateurs.id");
    $displayUser->execute();
    $result = $displayUser->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    // si je ne retourne pas le résultat, je ne pourrai pas utiliser mon $result ailleurs.
}
// var_dump(displayUser($bd));

?>
<table>

    <?php
    $result = displayUser($bd); ?>
    <tr>
        <?php for ($i = 0; $i < count($result); $i++) :
        ?>
            <td> Ecrit par <?= $result[$i]['login']
                            ?></td>
            <td>: <?= $result[$i]['article']
                    ?></td>
        <?php endfor ?>
    </tr>

</table>
<button type="submit" name="inverser"> Inverser</button>