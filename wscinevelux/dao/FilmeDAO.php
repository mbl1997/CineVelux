<?php

include_once 'class/filme.php';
include_once 'bd/PDOFactory.php';

class FilmeDAO{

    public function inserir (Filme $filme){
        $query = "INSERT INTO filme (titulo, genero) VALUES (:titulo, :genero) ";
        $pdo = PDOFactory:: getConexao();
        $comando = $pdo->prepare($query);
        $comando->bindParam(":titulo", $filme->titulo);
        $comando->bindParam(":genero", $filme->genero);
        $comando->execute();
        $filmes->id = $pdo->lastInsertid();
        return $filme;
    }

    
    public function listar(){
        $query = "SELECT * FROM filme";
        $pdo = PDOFactory::getConexao();
        $comando = $pdo->prepare($query);
        $comando->execute();
        $usuario = array();
        while($row = $comando->fetch(PDO::FETCH_OBJ)){
            $filme[] = new Filme($row->id, $row->titulo, $row->genero);
        }
        return $filme;
    }
      

    
    public function buscarPorId($id) {
        $query = "SELECT * FROM filme WHERE id = :id";
        $pdo = PDOFactory::getConexao();
        $comando = $pdo->prepare($query);
        $comando->bindParam(":id", $id);
        $comando->execute();
        $resultado = $comando->fetch(PDO::FETCH_OBJ);
        return new Filme($resultado->id, $resultado->titulo, $resultado->genero);
    }

      public function deletar($id){
       $query = "DELETE FROM filme WHERE id = :id";
       $pdo = PDOFactory::getConexao();
       $comando = $pdo->prepare($query);
       $comando->bindParam(":id", $id);
       $comando->execute();
   }

}




?>