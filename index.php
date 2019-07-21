<?php

require_once 'Router/Router.php';
require_once 'templates/templates.php';


$router = new Router();


$router->error('404', function(){
    return "<h1>Oh, Oh. No logramos encontrar lo que buscas.</h1>";
});

$router->get('/', function(){
    return HomePage();
});