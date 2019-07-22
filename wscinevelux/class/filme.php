<?php

class Filme{

    public $id;
    public $titulo;
    public $genero;


    function __construct($id, $titulo, $genero){
        $this->id = $id;
        $this->titulo = $titulo;
        $this->genero = $genero;
    }
}

?>