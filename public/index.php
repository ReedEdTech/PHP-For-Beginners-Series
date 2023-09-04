<?php

use Core\Session; 
use Core\ValidationException;

session_start(); //call this early to create the sessioN!

const BASE_PATH = __DIR__.'/../';

require BASE_PATH . '/vendor/autoload.php';

require BASE_PATH.'Core/functions.php';


/* the vendor/autoload line above replaced this stuff
spl_autoload_register(function ($class) {
    // Core\Database
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});
*/

require base_path('bootstrap.php');


$router = new \Core\Router();

$routes = require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

//IF there is a _method field in the post request, use IT
//otherwise use the method (get/post) that you received from the server
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try{
    $router->route($uri, $method);
}
catch( ValidationException $exception ){ //invalid formats on login credentials?  Handle it
    //trick:  use a _flashed key to indicate that it needs to get cleared on next page load
    //$_SESSION['_flashed']['errors'] = $form->errors();
    Session::flash( 'errors', $exception->errors );
    //Failed login attempt?  Let's flash their bad credentials so we can keep them in the input boxes
    //don't pass password for security reason
    Session::flash( 'old', $exception->old);

    //redirect to login page
    //return redirect('/login'); //this sends us to the session/create controller
    //make this smart enough to redirection to where you came from (not always login)
    return redirect( $router->previousUrl() );
}

//NOW we can expired the '_flashed' session data
Session::unflash();


