<?php
require_once "./class/comentario.php";
require_once "./dao/ComentarioDAO.php";

class ComentarioController {

    public function listar($req, $resp, $args) {
        $dao = new ComentarioDAO();
        $lista = $dao->listar();
        $resp = $resp->withJson($lista);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function buscarPorId($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new ComentarioDao();
        $comentario = $dao->buscarPorId($id);
        $resp = $resp->withJson($comentario);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function inserir($req, $resp, $args) {
        $var = $req->getParsedBody();
        $comentario = new Comentario(0, $var["mensagem"]);
        $dao = new ComentarioDao();
        $dao->inserir($comentario);
        $resp = $resp->withJson($comentario);
        $resp = $resp->withHeader("Content-type", "application/json");
        $resp = $resp->withStatus(201);
        return $resp;
    }

  
    public function deletar($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new ComentarioDAO();
        $comentario = $dao->buscarPorId($id);
        $dao->deletar($id);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }
}
?>