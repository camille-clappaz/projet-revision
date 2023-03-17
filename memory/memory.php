<?php
require("Card.php");
$state = "false";
$id_card = 1;
$img_face_down = "urldown";
$img_face_up = "urlup";

for ($i = 0; $i < 3; $i++) {
    $card[$i] = new Card($id_card, $img_face_down, $img_face_up, $state);
    $card[$i]->setId_card($i);
    $card[$i]->setImg_face_up($i . "up");
    $card[$i]->setState("false");
    $array1= array($card);
}
for ($i = 0; $i < 3; $i++) {
    $card[$i] = new Card($id_card, $img_face_down, $img_face_up, $state);
    $card[$i]->setId_card($i);
    $card[$i]->setImg_face_up($i . "up");
    $card[$i]->setState("false");
    $array2= array($card);
}
$array = array_merge($array1, $array2);

var_dump($card[1]);



// if (isset($_POST["retourner"])) {
//     if ($_POST["retourner"] == "false") { // avec un seul = ça ne fonctionne pas ATTENTION!!!!
//         $state = "true";
//         $card->setState($state); // important pour mettre a jour le $state
//         $card->state();
//     } else {
//         $state = "false";
//         $card->setState($state);
//         $card->state();
//     }
// } else {
//     $state = "false";
//     $card->setState($state);
//     $card->state();
// }





// var_dump($array, $array1, $array2);
// var_dump($_GET);
?>
<form action="" method="post">
    <button type="submit" name="retourner" value=<?= $state ?>>Retourner</button>
</form>

