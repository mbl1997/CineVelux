<?php
// chamada do namespace da biblioteca de autenticação do JWT para Slim
use \Tuupola\Middleware\JwtAuthentication;

// criação de uma função com retorno de objeto JwtAuthentication
function jwtAuth() : JwtAuthentication {

    return new JwtAuthentication(
        [
            // deve ser adicionado o secretkey usado na geração dos tokens
            "secret" => "p3ss4o1d",
            // cria um atributo como identificador para decodificação
            "attribute" => "jwt",
            // camada de seguraça para HTTPS
            "secure" => false,
            // libera o acesso para testes em localhost
            "relaxed" => ["localhost"],
            // estabelece comportamento ao haver erro na decodificação do token
            "error" => function($response, $args) {
                        $data["status"] = "error";
                        $data["message"] = $args["message"];
                        return $response
                               ->withHeader("Content-type", "application/json")
                               ->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
                    } 
        ]
    );

}


?>