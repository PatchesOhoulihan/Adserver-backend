<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


//Get Banner Types
$app->get('/api/bannertypes', function(Request $request, Response $response){
    $this->logger->info("client asks for 'bannertypes' route");
    
    $sql =  "SELECT DISTINCT mt.width, mt.height , mt.position, mt.hour FROM (SELECT * FROM table1 UNION SELECT * FROM table2) as mt";
    $stmt = $this->db->query($sql);
    
    $result = $stmt->fetchAll();
    
    return $response->withJson($result);
});

//Get Banner
$app->post('/api/loadad', function(Request $request, Response $response){
    $this->logger->info("client asks for new Banners on: '/api/loadad'");
    
    $params = $request->getParsedBody();
    
    $banner = array();
    
    foreach($params AS $bannerDimensions) {
    
        $stmt = $this->db->prepare("SELECT advert_id, min(priority), position, hour, image, link, width, height, views, table_name FROM 
        (SELECT *, 'table1' as table_name FROM table1 UNION SELECT *, 'table2' as table_name FROM table2) as mt 
        WHERE width=:width AND height=:height AND position=:position AND hour=:hour
        GROUP BY advert_id, position, hour, image, link, width, height, views, table_name
        ORDER BY advert_id, position, hour, image, link, width, height, views, table_name");
   
        $stmt->execute($bannerDimensions);       
        $result = $stmt->fetchAll();
        
        if (count($result) == 0){
            
        }else{
            
            if(count($result) == 1)
            {
                $result = $result[0];
                
            }else if(count($result) > 1){
                $bannercadidate = $result[0];
                $views = $result[0]['views'];
                
                foreach($result as $row){
                  
                    if($row['views'] <= $views){
                        $bannercadidate = $row;    
                    }    
                }
            
                $result = $bannercadidate;         
            }
            $this->db->query("UPDATE ".$result['table_name']." SET views = views + 1 WHERE advert_id =".$result['advert_id'].";");               
            array_push($banner, array("pos"=>$result['position'], "width"=>$result['width'], "height"=>$result['height'], "image"=>$result['image'],"link"=>$result['link'],"time"=>$result['hour']));
        }
    }           
    return $response->withJson($banner);
});

