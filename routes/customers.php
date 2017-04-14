<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


//Get Banner Types
$app->get('/api/bannertypes', function(Request $request, Response $response){
    $sql = "SELECT * FROM table1";
    $stmt = $this->db->query($sql);
    
    $result = $stmt->fetchAll();
    
    //$response->getBody()->write($json);
    
    $this->logger->info("client asks for 'bannertypes' route");
    
    return $response->withJson($result);
});

