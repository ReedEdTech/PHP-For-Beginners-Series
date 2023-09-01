<?php

namespace Core\Middleware;

class Middleware{

    public const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    public static function resolve( $key ){

        if( !$key ){ //no key at all!
            return; //nothing to do here        
        }

        //this returns the correct CLASS
        $middleware = static::MAP[ $key ] ?? false;  //if $key doesn't exit, set var to false

        if( !$middleware ){  //you gave us a bogus key, so I got null
            throw new \Exception("No matching middleware found for key '{$key}'.");
        }

        //now I instantiate an object of that class & call the handle function
        (new $middleware)->handle(); //if this route's user requirements don't match your status, it will load the hompage & die
             

    }

}

