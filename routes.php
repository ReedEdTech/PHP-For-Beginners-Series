<?php

/*
return [
    '/' => 'index.php',
    '/about' => 'about.php',
    '/notes' => 'notes/index.php',
    '/note' => 'notes/show.php',
    '/notes/create' => 'notes/create.php',
    '/contact' => 'contact.php',
];
*/

//just push this info into the routes array inside my router object
$router->get("/about", "about.php");
$router->get("/contact", "contact.php");
$router->get("/", "index.php");

$router->delete("/note", "notes/destroy.php");
$router->get("/notes", "notes/index.php")->only("auth");
$router->get("/note", "notes/show.php");
$router->patch("/notes", "notes/update.php");

$router->get('/note/edit', 'notes/edit.php');

//view the creation interface
$router->get("/notes/create", 'notes/create.php'); 
$router->post("/notes", 'notes/store.php');

//registration options
$router->get("/register", "registration/create.php")->only('guest');
$router->post("/register", "registration/store.php");

//login stuff
$router->get("/login", "session/create.php")->only('guest');
$router->post("/session", "session/store.php")->only('guest');
$router->delete("/session", "session/destroy.php")->only('auth');