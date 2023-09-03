<?php

use Core\Session;

view('session/create.view.php', [
    //'errors' => $_SESSION['_flashed']['errors'] ?? []
    'errors' => Session::get( 'errors' ) ?? []
]);