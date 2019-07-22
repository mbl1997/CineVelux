<?php

require_once "./class/filme.php";
require_once "./dao/FilmeDAO.php";


class FilmeController{

    
    public function inserir($req, $resp, $args) {
        $var = $req->getParsedBody();
        $filme = new Filme(0, $var["titulo"], $var["genero"]);
        $dao = new FilmeDao();
        $dao->inserir($filme);
        $resp = $resp->withJson($filme);
        $resp = $resp->withHeader("Content-type", "application/json");
        $resp = $resp->withStatus(201);
        return $resp;
    }

    
    public function listar($req, $resp, $args) {
        $dao = new FilmeDAO();
        $lista = $dao->listar();
        $resp = $resp->withJson($lista);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    
    public function buscarPorId($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new FilmeDao();
        $filme = $dao->buscarPorId($id);
        $resp = $resp->withJson($filme);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function deletar($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new FilmeDAO();
        $filme = $dao->buscarPorId($id);
        $dao->deletar($id);
        $resp = $resp->withJson($filme);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }
    
}




?>