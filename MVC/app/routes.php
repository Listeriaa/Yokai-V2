 
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

//routes pour backoffice

$this->addRoute(
    'GET',
    '/admin',
    'BackController',
    'home',
    'back-main'
);
$this->addRoute(
    'GET',
    '/admin/yokai',
    'YokaiController',
    'backlist',
    'back-yokailist'
);
$this->addRoute(
    'GET',
    '/admin/yokai/add',
    'YokaiController',
    'add',
    'back-yokaiadd'
);
$this->addRoute(
    'POST',
    '/admin/yokai/add',
    'YokaiController',
    'createOrUpdate',
    'back-yokaicreate'
);
$this->addRoute(
    'GET',
    '/admin/yokai/update/[i:id]',
    'YokaiController',
    'add',
    'back-yokaiupdate'
);
$this->addRoute(
    'POST',
    '/admin/yokai/update/[i:id]',
    'YokaiController',
    'createOrUpdate',
    'back-yokaimodify'
);
$this->addRoute(
    'GET',
    '/admin/users',
    'UserController',
    'backlist',
    'back-userslist'
);
$this->addRoute(
    'GET',
    '/admin/test',
    'UserController',
    'test',
    'test'
);