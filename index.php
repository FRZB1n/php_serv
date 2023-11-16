<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: PUT, POST, GET, DELETE, PATCH");
// header('Content-type: application/json; charset=utf-8');

spl_autoload_register(function ($name){
    require_once __DIR__ . '/app/' . str_replace('\\', '/', $name) . '.php';
});

$flag = false;
$rout = $_GET['rout'] ?? '';
$router = require_once __DIR__ . '/app/router.php';

foreach ($router as $pattern => $value){
    preg_match($pattern, $rout , $match);
    if(!empty($match))
    {
        $flag=true;
        break;
    }
}

if(!$flag)
{
    http_response_code(404);
    echo json_encode(array('message'=>'page not found'));
    return;
}

unset($match[0]);

$controllerName = $value[0];
$controllerMethod = $value[1];

$action = new $controllerName();
$action -> $controllerMethod(...$match);

// $match;
// $match["id"] = 3;
// $match["hui"] = 15;

// function popa($hui, $id){
//     return 0;
// }