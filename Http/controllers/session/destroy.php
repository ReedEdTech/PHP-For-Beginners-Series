<?php
use Core\functions;
use Core\Authenticator;

//log the user out
$auth = new Authenticator();
$auth->logout();


//redirect to the homepage
redirect("/");
