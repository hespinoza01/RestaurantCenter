<?php

require_once 'Request.php';

class Router{
    private $request;
    private $supportedHttpMethods = array("GET", "POST");

    function __construct(){
        $this->request = new Request();
    }

    function __call($name, $args){
        list($route, $method) = $args;
        $name = strtoupper($name);

        if(!in_array($name, $this->supportedHttpMethods) && !$name=="ERROR") {
            $this->invalidMethodHandler();
        }

        if(!$name == "ERROR"){
            $this->{$name}[$this->formatRoute($route)] = $method;
        }else{
            $this->{$name}[$route] = $method;
        }
    }

    private function formatRoute($route){
        $result = rtrim($route, '/');

        return ($result === '') ? '/' : $result; // if $result is empty  return / else return $result value
    }

    private function invalidMethodHandler(){
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
        $methodDictionary = $this->{"ERROR"};
        $method = $methodDictionary["404"];

        if(!is_null($method)) {
            echo call_user_func($method);
        }else {
            echo "<h1>Error 405. Method Not Allowed.</h1>";
        }
    }

    private function defaultRequestHandler(){
        header("{$this->request->serverProtocol} 404 Not Found");
        $methodDictionary = $this->{"ERROR"};
        $method = $methodDictionary["404"];

        if(!is_null($method)) {
            echo call_user_func($method);
        }else{
            echo "<h1>Error 404. Page Not Found.</h1>";
        }
    }

    function resolve(){
        $methodDictionary = $this->{strtoupper($this->request->requestMethod)};
        $formatedRoute = $this->formatRoute($this->request->requestUri);
        $method = $methodDictionary[$formatedRoute];

        if(is_null($method)) {
            $this->defaultRequestHandler();
            return;
        }

        echo call_user_func_array($method, array($this->request));
    }

    function __destruct(){
        $this->resolve();
    }
}