<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


//Get Banner Types
$app->get('/api/bannertypes', function(Request $request, Response $response){
    $response->getBody()->write("Get me some Bannertypes, dude");
    
    $this->logger->info("client asks for 'bannertypes' route");

    return $response;
});

