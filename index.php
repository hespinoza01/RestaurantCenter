<?php

require_once 'Router/Router.php';

$router = new Router();

$router->error('404', function(){
    return "<h1>Oh, Oh. No logramos encontrar lo que buscas.</h1>";
});

$router->get('/', function(){
    echo "Index";
});

$router->get('/other', function(){
    return "<h1>Other</h1>";
});