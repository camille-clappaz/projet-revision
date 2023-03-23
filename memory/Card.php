<!DOCTYPE html>
<html lang="en">
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
session_start();

class Card
{
    public $id_card;
    public $img_face_down;
    public $img_face_up;
    public $state;

    public function __construct(
        $id_card,
        $img_face_down ,
        $img_face_up,
        $state=false

    ) {
        $this->id_card = $id_card;
        $this->img_face_down = $img_face_down ;
        $this->img_face_up = $img_face_up ;
        $this->state = $state;
    }

    function getId_card(){
        return $this->id_card;
    }
    function setId_card($id_card){
        $this->id_card=$id_card;
    }
    function getImg_face_down(){
        return $this->img_face_down;
    }
    function setImg_face_down($img_face_down){
        $this->img_face_down=$img_face_down;
    }
    function getImg_face_up(){
        return $this->img_face_up;
    }
    function setImg_face_up($img_face_up){
        $this->img_face_up=$img_face_up;
    }
    function getState(){
        return $this->state;
    }
    function setState($state){
        $this->state=$state;
    }
    function state()
    {
        if ($this->state == true) { // !!!!! ATTENTION aux = & == !!!!!!!
            echo " <img src='$this->img_face_up.jpg' alt=''>";
            var_dump($this->img_face_up);
            return true;
        } else {
            echo " <img src='$this->img_face_down.jpg' alt=''>";
            var_dump($this->img_face_down);
            return false;
        }
        
    }

}
// $card=new Card("", "", "", "");
// var_dump($card);
