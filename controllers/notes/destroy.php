<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$currentUserId = 1;

//dd($_POST);//<<<<<<<<<<<<<<<< Did I get here?

//make sure they have the rights to delete this note
$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

//survived the authorzie check
//delete it from the db (grabbing id from hidden field)
$db->query( 'delete from notes where id=:id',[
    'id'=>$_POST['id']
]);

//take them to the page with all notes
header('location: /notes');
exit();

