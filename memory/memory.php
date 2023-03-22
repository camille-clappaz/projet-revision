<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
</body>

</html>
<?php

require("Card.php");

function creerCartes()
{
    $img_face_down = "issets\img\oeil_sauron.jpg";
    for ($i = 0; $i < 6; $i += 2) { // $i+=2 => $i=$i+2
        $card[$i] = new Card($i, $img_face_down, $i . ".jpg", false);
        $card[$i + 1] = new Card($i + 1, $img_face_down, $i . ".jpg", false);
    }
    $_SESSION['plateau'] = $card;
    return $_SESSION['plateau']; // NE PAS OUBLIER DE RETOURNER LE $card!!!!!!!
}
// var_dump($_SESSION['plateau']);
function afficherCartes()
{
    $cartes = creerCartes();

?>
    <form action="" method="get">
        <?php

        foreach ($cartes as $carte) {
            verifCarte($carte);
            if ($carte->getState() == false) {
        ?>
                <button type="submit" value="<?= $carte->getId_card(); ?>" name="retourner">
                    <img src="<?= $carte->getImg_face_down(); ?>" alt="">
                </button>
            <?php


            } else {
            ?>
                <button type="submit" value="<?= $carte->getId_card(); ?>" name="retourner">
                    <img src="issets\img\<?= $carte->getImg_face_up(); ?>" alt="">
                </button>
        <?php
            }
        }
        ?>
    </form>
<?php
}
function cliqueCarte($carte)
{
    if (isset($_GET['retourner'])) {
        if ($_GET['retourner'] == $carte->getId_card()) {
            // $carte->setState(true);
            return true;
        }
    }
}

function verifCarte($carte)
{
    if (cliqueCarte($carte)) { // on verifie qu'on a cliqué sur une carte grâce à son id.
        if (isset($_SESSION["2cartes"])) {
            if (count($_SESSION["2cartes"]) < 2) { //soit il y a 0,1 carte, si il y en a moins de 2 on peut ajouter une carte dans le tableau.
                $carte->setState(true); // on change son état pour qu'elle se retourne
                array_push($_SESSION["2cartes"], $carte);
                var_dump($_SESSION["2cartes"]); // puis on la met dans notre variable de session pour la laisser afficher
            } else {
                if ($_SESSION['2cartes'][0]->img_face_up == $_SESSION['2cartes'][1]->img_face_up) {
                    // $_SESSION['2cartes'][0]->setState(true);
                    // $_SESSION['2cartes'][1]->setState(true);
                    // $_SESSION["trueCartes"]=[];
                    // array_push($_SESSION['trueCartes'], $_SESSION['2cartes']);
                    echo " paire de carte";
                } else {
                    echo "pas les memes";
                }
                // $_SESSION['2cartes'][0]->setState(true); 
                // $_SESSION['2cartes'][1]->setState(true);
                $_SESSION["2cartes"] = [];
            }
        } else {
            $_SESSION["2cartes"] = [];
        }
        // si il y en a deux, le tableau se vide et la carte sur laquelle on a cliquer se met à la place

    }
}

// var_dump($_SESSION['2cartes']);

function resetGame()
{
    if (isset($_GET['reset'])) {
        session_destroy();
        header('location: memory.php');
    }
}
resetGame();

AfficherCartes();

var_dump($_SESSION);




?>
<form action="" method="get">
    <button type="submit" name="reset">RESET</button>
</form>