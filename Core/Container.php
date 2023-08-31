<?php

namespace Core;

class Container{
    //associative array:  key - > function
    protected $bindings = [];

    public function bind( $key, $resolver ){ //adding
        //pus this function into the array paired with key
        $this->bindings[$key] = $resolver;
    }

    public function resolve( $key ){ //accessing
        //do I have that key?
        if( !array_key_exists( $key, $this->bindings) ){
            throw new \Exception("No matching binding found for {$key}");
        }
        //grab the function out of the array
        $resolver = $this->bindings[$key];
        //call the function and return the result
        return call_user_func( $resolver );
        
    }

}