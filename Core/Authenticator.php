<?php

namespace Core;

use Core\Database;
use Core\Session;

class Authenticator{

    public function attempt( $email, $password ){
        //grab this user's password from the db
        $user = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', [
            'email'=>$email
        ] ) -> find();


        if( $user ){ //found user with this email

            //did they supply the correct password??
            if( password_verify( $password, $user['password'] ) ){ 
                //store info in _SESSION
                $this->login( ['email'=>$email ] );
        
                return true;
            } 
        }
        return false;
    }


    public function login( $user ){ //$user is an ARRAY 
        $_SESSION[ 'user' ] = [
            'email' => $user['email']
        ];
    
        //something about refreshing their cookie?
        session_regenerate_id(true);
    }
    
    public function logout(){
        //log the user out
        Session::destroy();
    }

}