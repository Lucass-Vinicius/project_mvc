<?php 

require_once __DIR__ . "/../vendor/autoload.php";

//FRONT CONTROLLER

use Src\Video\models\Entity\Video;
use Src\Video\Controllers\Error404Controller;

$obVideo = new Video; 

$routes = require_once __DIR__ . '/../config/routes.php';
$httpMethod = $_SERVER['REQUEST_METHOD'];
$requestURI = parse_url($_SERVER['REQUEST_URI']); $requestURI = $requestURI['path'] ?? '/';
$key = "$httpMethod$requestURI";

if (array_key_exists($key, $routes)) {
    $controllerClass = $routes["$httpMethod$requestURI"];
    $controller = new $controllerClass($obVideo);
} else {
    $controller = new Error404Controller();
}
$controller->processaRequisicao();

// (array_key_exists($key, $routes)) ? $controllerClass = $routes["$httpMethod$requestURI"] && $controller = new $controllerClass($obVideo) : $controller = new Error404Controller();l