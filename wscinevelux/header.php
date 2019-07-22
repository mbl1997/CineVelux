<?php
// include para criação de conexão com banco de dados
require_once "bd/PDOFactory.php";

// includes de controllers
require_once "controller/FilmeController.php";
require_once "controller/UsuarioController.php";
require_once "controller/ComentarioController.php";

// includes de autenticação
require_once "jwt/jwtauth.php";
require_once "jwt/jwtmiddleware.php";

// include de autoload do Slim
require "vendor/autoload.php";

// configuração do Slim para exibição dos detalhes na ocorrência de erros
$config = [
	'settings'             => [
		'displayErrorDetails' => true
	],
];
?>