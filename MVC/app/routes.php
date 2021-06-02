 
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
//Route for home FRONT

$this->addRoute(
    'GET',
    '/',
    'MainController',
    'home',
    'main-home'
);

//routes for yokai FRONT
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

//routes for backoffice
// BACK Homepage
$this->addRoute(
    'GET',
    '/admin',
    'BackController',
    'home',
    'back-home'
);
//BACK yokai List
$this->addRoute(
    'GET',
    '/admin/yokai',
    'YokaiController',
    'backlist',
    'yokai-backlist'
);

//BACK yokai add or modify
$this->addRoute(
    'GET',
    '/admin/yokai/add',
    'YokaiController',
    'add',
    'yokai-add'
);
$this->addRoute(
    'GET',
    '/admin/yokai/update/[i:id]',
    'YokaiController',
    'add',
    'yokai-update'
);
//BACK yokai POST to add
$this->addRoute(
    'POST',
    '/admin/yokai/add',
    'YokaiController',
    'createOrUpdate',
    'yokai-create'
);
//BACK yokai POST to update
$this->addRoute(
    'POST',
    '/admin/yokai/update/[i:id]',
    'YokaiController',
    'createOrUpdate',
    'yokai-modify'
);
//BACK login
$this->addRoute(
    'GET',
    '/admin/login',
    'UserController',
    'login',
    'user-login'
);
//BACK login POST
$this->addRoute(
    'POST',
    '/admin/login',
    'UserController',
    'doLogin',
    'user-doLogin'
);
//BACK users List
$this->addRoute(
    'GET',
    '/admin/user',
    'UserController',
    'list',
    'user-list'
);
//BACK user add or modify
$this->addRoute(
    'GET',
    '/admin/user/add',
    'UserController',
    'add',
    'user-add'
);
$this->addRoute(
    'GET',
    '/admin/user/update/[i:id]',
    'UserController',
    'add',
    'user-update'
);
//BACK user POST to add
$this->addRoute(
    'POST',
    '/admin/user/add',
    'UserController',
    'createOrUpdate',
    'user-create'
);
//BACK user POST to update
$this->addRoute(
    'POST',
    '/admin/user/update/[i:id]',
    'UserController',
    'createOrUpdate',
    'user-modify'
);
//test route
$this->addRoute(
    'GET',
    '/admin/test',
    'UserController',
    'test',
    'test'
);