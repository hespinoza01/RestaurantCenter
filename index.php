<?php

require_once 'Router/Router.php';
require_once 'templates/templates.php';


$router = new Router();

// header directives for evit file caching
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Connection: close");


$router->error('404', function(){
    return "<h1>Oh, Oh. No logramos encontrar lo que buscas.</h1>";
});

$router->get('/', function(){
    return HomePage();
});