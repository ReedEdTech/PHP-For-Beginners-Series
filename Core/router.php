<?php

namespace Core;

class Router{
    protected $routes = [];

    public function add($method, $uri, $controller){
        $this->routes[]=[
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function get( $uri, $controller ){
        //push a new item onto the routes array
        $this->add("GET", $uri, $controller);
    }
    public function post($uri, $controller){
        $this->add("POST", $uri, $controller);
    }
    public function delete($uri, $controller){
        $this->add("DELETE", $uri, $controller);
    }
    public function patch($uri, $controller){
        $this->add("PATCH", $uri, $controller);
    }
    public function put($uri, $controller){
        $this->add("POST", $uri, $controller);
    }

    public function route($uri, $method){
        
        //loop through our routes array
        foreach( $this->routes as $route){
        
            //if the uri AND method of the array match what we received
            if( $route['uri'] == $uri && $route['method'] == strtoupper($method)){                
                return require base_path($route['controller']);
            }
        }//end for
        
        //never found a match.  Abort
        $this -> abort();

    }

    protected function abort($code = 404) {
        http_response_code($code);
    
        require base_path("views/{$code}.php");
    
        die();
    }

}//end class

/*
 function routeToController($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        require base_path($routes[$uri]);
    } else {
        abort();
    }
}



$routes = require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

routeToController($uri, $routes);
*/