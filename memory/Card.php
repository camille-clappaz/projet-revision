<?php
session_start();
class Card
{
    private $id_card;
    private $img_face_down;
    private $img_face_up;
    private $state;

    public function __construct(
        $id_card,
        $img_face_down,
        $img_face_up,
        $state=false

    ) {
        $this->id_card = $id_card;
        $this->img_face_down = $img_face_down;
        $this->img_face_up = $img_face_up;
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
   

}
// $card=new Card("", "", "", "");
// var_dump($card);