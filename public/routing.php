<?php
function route($controller, $action)
{
    $controller = ucfirst($controller);

    require_once('controllers/' . $controller . 'Controller.php');

    $controllerName = $controller . 'Controller';
    $controller = new $controllerName();

    $controller->{ $action . 'Action' }();
}

define("__WWW__", __DIR__ . "/");
define("__ROOT__", __DIR__ . "/../");

$controllers = [
    'index' => ['index', 'error', 'getISSLocation']
];

if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        route($controller, $action);
    } else {
        route('index', 'error');
    }
} else {
    route('index', 'error');
}
