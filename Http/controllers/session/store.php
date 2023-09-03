<?php

use Http\Forms\LoginForm;
use Core\Authenticator;
use Core\Session;


$email = $_POST['email'];
$password = $_POST['password'];


$form = new LoginForm();

//if the form did NOT pass validation
if( $form->validate( $email, $password ) ){
    //log in the user

    //correct password?
    if( (new Authenticator())->attempt( $email, $password ) ){
        //successful login!  redirect to homepage
        redirect("/"); 
        exit();
    }
    else{ //wrong credentials 
        //register this error with the form
        $form->error( 'email' , 'No user found for this email & password.' );
    }
}

//trick:  use a _flashed key to indicate that it needs to get cleared on next page load
//$_SESSION['_flashed']['errors'] = $form->errors();
Session::flash( 'errors', $form->errors() );

//Failed login attempt?  Let's flash their bad credentials so we can keep them in the input boxes
//don't pass password for security reason
Session::flash( 'old', [
    'email' => $email
]);


return redirect('/login'); //this sends us to the session/create controller

/*
//THis is not a good way to handle things.  We need to redirect!  Not just reload
//no user OR wrong password:  reload the view with errors
return view('session/create.view.php', [
    'errors' => $form->errors()
]);
*/





