<?php

use Core\Response;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404){
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (! $condition) {
        abort($status);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('views/' . $path);
}

function login( $user ){ //$user is an ARRAY 
    $_SESSION[ 'user' ] = [
        'email' => $user['email']
    ];

    //something about refreshing their cookie?
    session_regenerate_id(true);
}

function logout(){
    //log the user out
    $_SESSION = [];  //clear out all session data

    session_destroy(); //delete the session data stored on server

    //clear the cookie
    $params = session_get_cookie_params(); //parameters for the cookie
    //name=PHPSESSID, val? , exp time = 1 hour ago
    setcookie('PHPSESSID', '', time()-3600, $params['path'], $params['domain']);
}