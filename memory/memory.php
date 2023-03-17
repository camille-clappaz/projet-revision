<?php
require("Card.php");
$state = "false";
$id_card = 1;
$img_face_down = "urldown";
$img_face_up = "urlup";

if (isset($_GET["retourner"])) {
    $state = "false";
    $id_card = 1;
    $img_face_down = "urldown";
    $img_face_up = "urlup";

    if ($_GET["retourner"] == "false") {// avec un seul = ça ne fonctionne pas ATTENTION!!!!
        $state='true';
        echo $img_face_up;
    } else {
        $state="false";
        echo $img_face_down;
    }
}
else{
    echo $img_face_down;
}



$card = new Card($id_card, $img_face_down, $img_face_up, $state);
var_dump($card);
var_dump($_GET);
?>
<form action="" method="get">
    <button type="submit" name="retourner" value=<?= $state ?>>Retourner</button>
</form>