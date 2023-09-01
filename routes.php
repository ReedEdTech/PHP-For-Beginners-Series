<?php

/*
return [
    '/' => 'controllers/index.php',
    '/about' => 'controllers/about.php',
    '/notes' => 'controllers/notes/index.php',
    '/note' => 'controllers/notes/show.php',
    '/notes/create' => 'controllers/notes/create.php',
    '/contact' => 'controllers/contact.php',
];
*/

//just push this info into the routes array inside my router object
$router->get("/", "controllers/index.php");
$router->get("/about", "controllers/about.php");
$router->get("/contact", "controllers/contact.php");

$router->delete("/note", "controllers/notes/destroy.php");
$router->get("/notes", "controllers/notes/index.php");
$router->get("/note", "controllers/notes/show.php");
$router->patch("/notes", "controllers/notes/update.php");

$router->get('/note/edit', 'controllers/notes/edit.php');

//view the creation interface
$router->get("/notes/create", 'controllers/notes/create.php'); 
$router->post("/notes", 'controllers/notes/store.php');

