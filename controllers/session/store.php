<?php
use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve( Database::class );

$email = $_POST['email'];
$password = $_POST['password'];

//validate form inputs
$errors = [];
if( !Validator::email($email) )
    $errors['email'] = 'Please provide a valid email address';
if( !Validator::string($password ) )
    $errors['password'] = 'Please enter a valid password';

if( !empty( $errors) ){
    return view('session/create.view.php', [
        'errors' => $errors
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






