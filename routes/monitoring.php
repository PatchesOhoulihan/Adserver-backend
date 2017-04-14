<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;



$app->get('/', function (Request $request, Response $response) {
    
    $this->logger->info("client asks for '/' route");
    
    return $this->renderer->render($response, 'index.phtml');
});

