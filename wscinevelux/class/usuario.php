<?php

class Usuario{

    public $id;
    public $login;
    public $senha;


    function __construct($id, $login, $senha){

        $this->id = $id;
        $this->login = $login;
        $this->senha = $senha;
    }

}

?>