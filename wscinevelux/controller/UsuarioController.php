<?php

use \Firebase\JWT\JWT;

include_once "./class/usuario.php";
include_once "./dao/UsuarioDAO.php";

class UsuarioController{

     private $secretkey = "p3ss4o1d";

    public function buscarPorId($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new UsuarioDao();
        $produto = $dao->buscarPorId($id);
        $resp = $resp->withJson($usuario);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function inserir($req, $resp, $args) {
        $var = $req->getParsedBody();
        $usuario = new Usuario(0, $var["login"], $var["senha"]);
        $dao = new UsuarioDao();
        $dao->inserir($usuario);
        $resp = $resp->withJson($usuario);
        $resp = $resp->withHeader("Content-type", "application/json");
        $resp = $resp->withStatus(201);
        return $resp;
    }

    public function listar($req, $resp, $args) {
        $dao = new UsuarioDAO();
        $lista = $dao->listar();
        $resp = $resp->withJson($lista);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }

    public function deletar($req, $resp, $args) {
        $id = (int) $args["id"];
        $dao = new UsuarioDAO();
        $produto = $dao->buscarPorId($id);
        $dao->deletar($id);
        $resp = $resp->withHeader("Content-type", "application/json");
        return $resp;
    }


     public function autenticar($req, $resp, $args){
            $var = $req->getParsedBody();
            $dao = new UsuarioDAO();
            $usuario = $dao->buscarPorLogin($var["login"]);
            if($usuario == false){
				echo "401";//$resp->withStatus(401);
            }else{
                if($usuario->senha == $var["senha"]){

                    $tokenpayload = array(
                        "usuario_id" => $usuario->id,
                        "usuario_login" =>$usuario->login,
                        "data_expira" => time() + (60 * 60));
                    $token = JWT::encode($tokenpayload, $this->secretkey);
                    return $resp->withJson(["token" => $token]);
                }else{
                    return "401";//$resp->withStatus(401);
                }
            }
     }

}

?>