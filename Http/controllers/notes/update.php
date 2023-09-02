<?php

use Core\Database;
use Core\App;
use Core\Validator;

//grabe the database
$db = App::resolve("Core\Database");
$currentUserId = 1;

//find the record using the ID we got from the form
$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

//make sure I am the author of the note to begin with
authorize($note['user_id'] === $currentUserId);

//make sure they didn't type anything stupid in the form
$errors = [];

if (! Validator::string($_POST['body'], 1, 50)) {
      $errors['body'] = 'A body of no more than 50 characters is required.';
}


//Validation issue?  Drop them back on the edit page
if( !empty($errors)){
    return view("notes/edit.view.php", [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

//now i need to update the record in the database
$body = $_POST['body'];
$db->query('update notes set body = :body where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body']
]);

//redirect the user
header('location: /notes');
die();

