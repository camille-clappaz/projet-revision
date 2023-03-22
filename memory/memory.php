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
    return $card; // NE PAS OUBLIER DE RETOURNER LE $card!!!!!!!
}
// var_dump($_SESSION['plateau']);
function afficherCartes()
{
    $card = creerCartes();
    
?>
    <form action="" method="get">
        <?php

        foreach ($_SESSION["plateau"] as $cartes) {
            cliqueCarte($cartes);
            if ($cartes->getState() == false) {
        ?>
                <button type="submit" value="<?= $cartes->getId_card() ?>" name="retourner">
                    <img src="<?= $cartes->getImg_face_down() ?>" alt="">
                </button>
            <?php


            } else {
            ?>
                <button type="submit" value="<?= $cartes->getId_card() ?>" name="retourner">
                    <img src="issets\img\<?= $cartes->getImg_face_up() ?>" alt="">
                </button>
        <?php
            }
        }
        ?>
    </form>
<?php
}
function cliqueCarte($cartes)
{
    if (isset($_GET['retourner'])) {
        if ($_GET['retourner'] == $cartes->getId_card()) {
            $cartes->setState(true);
            return true;
        }
    }
}




// function resetGame()
// {
//     if (isset($_GET['reset'])) {
//         session_destroy();
//         unset($_GET);
//         header('location: memory.php');
//     }
// }
// resetGame();
AfficherCartes();
// var_dump($_SESSION);
// resetGame();




?>
<form action="" method="get">
    <button type="submit" name="reset">RESET</button>
</form>






