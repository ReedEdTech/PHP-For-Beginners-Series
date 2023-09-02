<?php

use Http\Forms\LoginForm;
use Core\Authenticator;


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

//no user OR wrong password:  reload the view with errors
return view('session/create.view.php', [
    'errors' => $form->errors()
]);






