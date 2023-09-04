<?php

use Core\Database;
use Core\Validator;
use Core\App;

$db = App::resolve("Core\Database");

$errors = [];

//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (! Validator::string($_POST['body'], 1, 50)) {
      $errors['body'] = 'A body of no more than 50 characters is required.';
}

//Validation issue
if( !empty($errors)){
    return view("notes/create.view.php", [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

//everything must be good
$db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => $_SESSION['user']['id']
]);
header('location: /notes');
die();

//}


/*

*/
