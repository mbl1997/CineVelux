<?php

require_once "header.php";

$app = new \Slim\App($config);


$app->post("/auth", "UsuarioController:autenticar");


$app->group("/filme",function () {	
		$this->post("", "FilmeController:inserir");
		$this->get("","FilmeController:listar");
		$this->get("/{id:[0-9]+}", "FilmeController:buscarPorId");
		$this->delete("/{id:[0-9]+}", "FilmeController:deletar");
	})
	->add(new JwtMiddleware()) 
	->add(jwtAuth()); 



$app->group("/usuario",function () {
	$this->post("", "UsuarioController:inserir");
	$this->get("","UsuarioController:listar");
	$this->get("/{id:[0-9]+}", "UsuarioController:buscarPorId");
	$this->delete("/{id:[0-9]+}", "UsuarioController:deletar");
})
->add(new JwtMiddleware()) 
->add(jwtAuth()); 



$app->group("/comentario",function () {
	$this->post("", "ComentarioController:inserir");
	$this->get("","ComentarioController:listar");
	$this->get("/{id:[0-9]+}", "ComentarioController:buscarPorId");
	$this->delete("/{id:[0-9]+}", "ComentarioController:deletar");
})

->add(new JwtMiddleware()) 
->add(jwtAuth()); 

$app->run();

?>
