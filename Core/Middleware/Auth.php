<?php

namespace Core\Middleware;

class Auth{

    public function handle(){
        if( !array_key_exists( 'user', $_SESSION  ) ){ //you aren't logged in
            header('location: /');
            exit();
        }
    }

}