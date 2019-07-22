<?php

include_once "class/comentario.php";
include_once "bd/PDOFactory.php";


class ComentarioDAO{

   public function inserir(Comentario $comentario){
       $query = "INSERT INTO comentario(mensagem) VALUES (:mensagem)";
       $pdo = PDOFactory::getConexao();
       $comando = $pdo->prepare($query);
       $comando->bindParam(":mensagem",$comentario->mensagem);
       $comando->execute();
       $comentario->id = $pdo->lastInsertId();
       return $comentario;
   }

   public function listar(){
    $query = "SELECT * FROM comentario";
    $pdo = PDOFactory::getConexao();
    $comando = $pdo->prepare($query);
    $comando->execute();
    $comentario = array();
    while($row = $comando->fetch(PDO::FETCH_OBJ)){
        $comentario[] = new Comentario($row->id, $row->mensagem);
    }
    return $comentario;
}

    public function buscarPorId($id){
       $query = "SELECT * FROM comentario WHERE id = :id";
       $pdo = PDOFactory::getConexao();
       $comando = $pdo->prepare($query);
       $comando->bindParam("id", $id);
       $comando->execute();
       $resultado = $comando->fetch(PDO::FETCH_OBJ);
       return new Comentario($resultado->id, $resultado->mensagem);
   }

   public function deletar($id){
       $query = "DELETE from comentario WHERE id = :id";            
       $pdo = PDOFactory::getConexao();
       $comando = $pdo->prepare($query);
       $comando->bindParam(":id", $id);
       $comando->execute();
   }

   }

?>