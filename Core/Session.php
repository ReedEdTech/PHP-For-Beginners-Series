<?php

namespace Core;

class Session{

    public static function has( $key ) {
        //I can cast as a boolean???
        return (bool) static::get( $key );

    }

    public static function put( $key, $value ){
        $_SESSION['$key'] = $value;
    }

    public static function get( $key , $default=null ){
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
        /*
        //first check to see if this $key is in the flashed/temp array
        if( isset( $_SESSION['_flash'][ $key ] ) ){
            //if it is, then return it from _flash
            return $_SESSION['_flash'][ $key ];
        }
        //
        //if they give us a $key that doesn't exist, we return their default val
        return $_SESSION[ $key ] ?? $default;
        */
    }

    public static function flash( $key, $value ){
        //put something into the session, but mark it as flashed (temporary)
        $_SESSION['_flash'][$key] = $value;
    }

    public static function unflash(){
        unset( $_SESSION['_flash'] );
    }

    public static function flush(){
        $_SESSION = [];
    }

    public static function destroy(){
        static::flush(); //clear out all session data
    
        session_destroy(); //delete the session data stored on server
    
        //clear the cookie
        $params = session_get_cookie_params(); //parameters for the cookie
        //name=PHPSESSID, val? , exp time = 1 hour ago
        setcookie('PHPSESSID', '', time()-3600, $params['path'], $params['domain']);

    }

}