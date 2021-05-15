 
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

//routes for yokai
$this->addRoute(
    'GET',
    '/yokai',
    'YokaiController',
    'list',
    'yokai-list'
);
$this->addRoute(
    'GET',
    '/yokai/[i:id]',
    'YokaiController',
    'showById',
    'yokai-showbyid'
);