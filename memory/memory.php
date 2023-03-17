<?php
require("Card.php");
$state = "false";
$id_card = 1;
$img_face_down = "urldown";
$img_face_up = "urlup";
$card = new Card($id_card, $img_face_down, $img_face_up, $state);
// if (isset($_POST["retourner"])) { //FONCTIONNE
//     $state = "false";
//     $id_card = 1;
//     $img_face_down = "urldown";
//     $img_face_up = "urlup";

//     if ($_POST["retourner"] == "false") {// avec un seul = ça ne fonctionne pas ATTENTION!!!!
//         $state='true';
//         echo $img_face_up;
//     } else {
//         $state="false";
//         echo $img_face_down;
//     }
// }
// else{
//     echo $img_face_down;
// }

if (isset($_POST["retourner"])) {
    if ($_POST["retourner"] == "false") { // avec un seul = ça ne fonctionne pas ATTENTION!!!!
        $state = "true";
        $card->setState($state);
        $card->state();
    } else {
        $state = "false";
        $card->setState($state);
        $card->state();
    }
} else {
    $state = "false";
    $card->setState($state);
    $card->state();
}




var_dump($card);
// var_dump($_GET);
?>
<form action="" method="post">
    <button type="submit" name="retourner" value=<?= $state ?>>Retourner</button>
</form>