<?php

use Http\Forms\LoginForm;
use Core\Authenticator;


//check to see if inputs are valid email format & password length

//weird:  this staic function returns a Form instance variable.  Store it for later
$form = LoginForm::validate( $attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
] );
//that threw an exception if it didn't validate > moved the catch to index.php

//still going?  no exception has been thrown
//correct password?
$signedIn = (new Authenticator())->attempt( 
    $attributes['email'], $attributes['password'] 
);

if( !$signedIn ){
    //wrong credentials 
    //register this error with the form
    $form->error( 
        'email' , 'No user found for this email & password.' 
        )->throw();
    //this will also throw an exception > handled on index, which reroutes you!
}

//successful login!  redirect to homepage
redirect("/"); 


/*
//THis is not a good way to handle things.  We need to redirect!  Not just reload
//no user OR wrong password:  reload the view with errors
return view('session/create.view.php', [
    'errors' => $form->errors()
]);
*/





