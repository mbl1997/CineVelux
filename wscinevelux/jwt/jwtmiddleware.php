<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class JwtMiddleware {

    public function __invoke(Request $req, Response $resp, callable $next) : Response {

        $token = $req->getAttribute("jwt");
        $resp = $next($req, $resp);       
        return $resp;
    } 
    
}

?>