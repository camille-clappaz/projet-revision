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
    $_SESSION['plateau']=$card;
    return $card; // NE PAS OUBLIER DE RETOURNER LE $card!!!!!!!
}
var_dump($_SESSION);
function afficherCartes()
{
    $card = creerCartes();
?>
    <form action="" method="get">
        <?php

        foreach ($card as $cartes) {
            if (isset($_GET["retourner"])) {
                if ($cartes->getState() == false) {
                    $cartes->setState(true);
        ?>
                    <button type="submit" value="<?= $cartes->getId_card() ?>" name="retourner">
                        <img src="<?= $cartes->getImg_face_up() ?>" alt="">
                    </button>



                <?php

                } else {
                    $cartes->setState(false);
                ?>
                    <button type="submit" value="<?= $cartes->getId_card() ?>" name="retourner">
                        <img src="issets\img\<?= $cartes->getImg_face_down() ?>" alt="">
                    </button>
        <?php
                }
            }
            else{
                $cartes->setState(false);
                ?>
                    <button type="submit" value="<?= $cartes->getId_card() ?>" name="retourner">
                        <img src="issets\img\<?= $cartes->getImg_face_down() ?>" alt="">
                    </button>
        <?php
            }
        }
        ?>
    </form>
<?php
}
AfficherCartes();

?>




<?php

// if (isset($_GET["retourner"])) {
//     if ($_GET["retourner"] == "false") { // avec un seul = ça ne fonctionne pas ATTENTION!!!!
//         $state = "true";
//         $value->setState($state); // important pour mettre a jour le $state
//         $value->state();
//         var_dump($value->state());
//     } else {
//         $state = "false";
//         $value->setState($state);
//         $value->state();
//         var_dump($value->state());
//     }
// } else {
//     $state = "false";
//     $value->setState($state);
//     $value->state();
//     var_dump($value->state());
// }
?>







<?php

// var_dump($key); // id_card
// var_dump($value); // objet Card 



// if (isset($_GET["retourner"])) {
//     if ($_GET["retourner"] == "false") { // avec un seul = ça ne fonctionne pas ATTENTION!!!!
//         $state = "true";
//         $value->setState($state); // important pour mettre a jour le $state
//         $value->state();
//         var_dump($value->state());
//     } else {
//         $state = "false";
//         $value->setState($state);
//         $value->state();
//         var_dump($value->state());
//     }
// } else {
//     $state = "false";
//     $value->setState($state);
//     $value->state();
//     var_dump($value->state());
// }
// 
?>
<!-- // <button type='submit' name='retourner' value=<?= $value->getState() ?>>Retourner</button> -->