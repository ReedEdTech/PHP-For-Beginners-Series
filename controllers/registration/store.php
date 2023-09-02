<?php

use Core\Validator;
use Core\Database;
use Core\App;

//dd($_POST['email'] . ": " . $_POST['password']);
$email = $_POST['email'];
$password = $_POST['password'];

//validate form inputs
$errors = [];
if( !Validator::email($email) )
    $errors['email'] = 'Please provide a valid email address';
if( !Validator::string($password, 7 , 255 ) )
    $errors['password'] = 'Please provide password between 7 and 255 chars';

if( !empty( $errors) ){
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

//check is account already exists
$db = App::resolve("Core\Database");
$currentUserId = 1;

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

//yes?  redirect to login
if( $user ){ //someone with that email already exists
    
    header('location: /');

    exit();
}
else{
//no?  save acct to db, log them in, & redirect
    $db->query('INSERT INTO users(email, password) VALUES (:email, :password)', [
        'email'=>$email,
        'password'=>password_hash( $password, PASSWORD_BCRYPT )
    ]);

    //remember that the user has logged in
    //$_SESSION[ 'user' ] = [ 'email'=>$email ];
    login( [ 'email'=>$email ] );

    header('location: / '); //redirect to homepage

    exit(); //kill the script
    
}

