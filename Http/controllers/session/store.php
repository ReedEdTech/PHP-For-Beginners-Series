<?php
use Core\App;
use Core\Database;
use Core\Validator;
use Http\Forms\LoginForm;

$db = App::resolve( Database::class );

$email = $_POST['email'];
$password = $_POST['password'];


$form = new LoginForm();

//if the form did NOT pass validation
if( !$form->validate( $email, $password ) ){
    //reload this page
    return view('session/create.view.php', [
        'errors' => $form->errors()
    ]);

}

//log in the user

//correct password?

//grab this user's password from the db
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email'=>$email
    ] ) -> find();



if( $user ){ //found user with this email

    //did they supply the correct password??
    if( password_verify( $password, $user['password'] ) ){ 
        //store info in _SESSION
        login( ['email'=>$email ] );

        //redirect to homepage
        header('location: /');
        exit();
    } 
}

//no user OR wrong password:  reload the view with errors
return view('session/create.view.php', [
    'errors' => [
        'email' => 'No user found for this email & password.'
    ]
]);






