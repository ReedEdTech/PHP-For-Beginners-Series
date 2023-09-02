<?php

/*  we moved this into the router!!!
//if we have a session user registered already
if( $_SESSION['user'] ?? false ){  
    //they dont' need the registration page!  
    //redirect them to the home page
    header("location: /");
    //and quit
    exit();

}
*/

view('registration/create.view.php');