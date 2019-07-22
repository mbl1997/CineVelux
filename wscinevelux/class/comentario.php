<?php
  

  class Comentario{

     public $id;
     public $mensagem;



     function __construct($id, $mensagem){
        $this->id = $id;
        $this->mensagem = $mensagem;
    }
  }





?>