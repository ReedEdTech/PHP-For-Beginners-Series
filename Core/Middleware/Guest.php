<?php

namespace Core\Middleware;

class Guest{

    public function handle(){
        if( $_SESSION['user'] ?? false ){ //you aren't a guest! 
            header('location: /'); //send you to homepage
            exit(); //quit running code
        }
    }


}