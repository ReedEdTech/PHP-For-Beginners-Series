<?php

namespace Core;

use Core\Middleware\Auth;
use Core\Middleware\Guest;
use Core\Middleware\Middleware;

class Router{
    protected $routes = [];

    public function add($method, $uri, $controller){
        $this->routes[]=[
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];
        return $this;
    }

    public function get( $uri, $controller ){
        //push a new item onto the routes array
        return $this->add("GET", $uri, $controller);
    }
    public function post($uri, $controller){
        return $this->add("POST", $uri, $controller);
    }
    public function delete($uri, $controller){
        return $this->add("DELETE", $uri, $controller);
    }
    public function patch($uri, $controller){
        return $this->add("PATCH", $uri, $controller);
    }
    public function put($uri, $controller){
        return $this->add("POST", $uri, $controller);
    }

    public function only( $key ){
        //grab the last item in the array
        //add a middleware key/val pair
        $this->routes[ array_key_last($this->routes) ]['middleware'] = $key;
        
        return $this;

    }

    public function route($uri, $method){
        
        //loop through our routes array
        foreach( $this->routes as $route){
        
            //if the uri AND method of the array match what we received
            if( $route['uri'] == $uri && $route['method'] == strtoupper($method)){
                
                //IF this route has middleware to deal with
                if( $route['middleware'] != null){
                    Middleware::resolve( $route['middleware'] );
                }

                //still here?  actually load your page
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