<?php

include_once "class/Usuario.php";
include_once "bd/PDOFactory.php";

class UsuarioDAO{

     public function buscarPorId($id){
        $query = "SELECT * FROM usuario WHERE id = :id";
        $pdo = PDOFactory::getConexao();
        $comando = $pdo->prepare($query);
        $comando->bindParam(":id", $id);
        $comando->execute();
        $resultado = $comando->fetch(PDO::FETCH_OBJ);
        return new Usuario($resultado->id, $resultado->login, $resultado->senha);
      }


      public function buscarPorLogin($login) {
    		$query   = "SELECT * FROM usuario WHERE login = :login";
    		$pdo     = PDOFactory::getConexao();
    		$comando = $pdo->prepare($query);
    		$comando->bindParam('login', $login);
    		$comando->execute();
    		$result = $comando->fetch(PDO::FETCH_OBJ);
    		
    		if(empty($result))
    			return false;
    		else
    			return new Usuario($result->id, $result->login, $result->senha);
  	   }

      public function inserir(Usuario $usuario){
          $query  = "INSERT INTO usuario(login, senha) VALUE (:login, :senha)";
          $pdo = PDOFactory::getConexao();
          $comando = $pdo->prepare($query);
          $comando->bindParam(":login",$usuario->login);
          $comando->bindParam(":senha",$usuario->senha);
          $comando->execute();
          $usuario->id = $pdo->lastInsertId();
          return $usuario;
      }
      
       public function listar(){
           $query = "SELECT * FROM usuario";
           $pdo = PDOFactory::getConexao();
           $comando = $pdo->prepare($query);
           $comando->execute();
           $usuario = array();
           while($row = $comando->fetch(PDO::FETCH_OBJ)){
               $usuario[] = new Usuario($row->id, $row->login, $row->senha);
           }
           return $usuario;
       }

       public function deletar($id){
           $query = "DELETE FROM usuario WHERE id = :id";
           $pdo = PDOFactory::getConexao();
           $comando = $pdo->prepare($query);
           $comando->bindParam(":id",$id);
           $comando->execute();
       }
}



?>