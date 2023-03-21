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
if (!isset($_SESSION["plateau"])) {
    afficherCartes();
}

function afficherCartes()
{
    $img_face_down = "issets\img\oeil_sauron";
    for ($i = 0; $i < 3; $i++) {
        $card[$i] = new Card("", $img_face_down, "", "");
        $card[$i]->setId_card($i);
        $card[$i]->setImg_face_up($i . ".jpg");
        $card[$i]->setImg_face_down($img_face_down . ".jpg");
        $card[$i]->setState("false");
        $array1 = $card;
    }
    for ($i = 0; $i < 3; $i++) {
        $card[$i] = new Card("", $img_face_down, "", "");
        $card[$i]->setId_card($i);
        $card[$i]->setImg_face_up($i . ".jpg");
        $card[$i]->setImg_face_down($img_face_down . ".jpg");
        $card[$i]->setState("false");
        $array2 = $card;
    }
    $array = array_merge($array1, $array2);
    $_SESSION['plateau'] = $array;

    // var_dump($_SESSION['plateau']);
?>
    <form action='' method='get'>
        <?php
        if (isset($_SESSION['plateau'])) {
            foreach ($_SESSION['plateau'] as $key => $value) {
                var_dump($key);
                var_dump($value);

                if (isset($_GET["retourner"])) {
                    if ($_GET["retourner"] == "false") { // avec un seul = ça ne fonctionne pas ATTENTION!!!!
                        $state = "true";
                        $value->setState($state); // important pour mettre a jour le $state
                        $value->state();
                        var_dump($value->state());
                    } else {
                        $state = "false";
                        $value->setState($state);
                        $value->state();
                        var_dump($value->state());
                    }
                } else {
                    $state = "false";
                    $value->setState($state);
                    $value->state();
                    var_dump($value->state());
                }
        ?>
                <button type='submit' name='retourner' value=<?= $value->getState() ?>>Retourner</button>

    <?php
            }
        }
    }
    ?>
    <button type="submit" name="reset">Reset</button>
    </form>
    <?php
    var_dump($_GET);
    if (isset($_GET['reset'])) {

        session_unset();
        session_destroy();
    }
    var_dump($_SESSION);
    // $card=new card($id_card, $img_face_down, $img_face_up, $state);
    ?>