 
<?php

/*
To map your routes, use this code
$this->addRoute(
    $httpMethod,
    $url,
    $controllerName,
    $methodName,
    $routeName
);
*/
//Route for home 

$this->addRoute(
    'GET',
    '/',
    'MainController',
    'home',
    'main-home'
);