<?php

use Core\Database;
use Core\App;

//$config = require base_path('config.php');
//$db = new Database($config['database']);
$db = App::resolve( "Core\Database" );
$userid = $_SESSION['user']['id'];
//dd('select * from notes where user_id = '.$userid);
$notes = $db->query('select * from notes where user_id = '.$userid)->get();

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);