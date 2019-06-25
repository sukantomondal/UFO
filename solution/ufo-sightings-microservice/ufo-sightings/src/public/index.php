<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';


// Instantiate the app
$settings = require '../app/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require '../app/dependencies.php';

// Register routes
require '../app/routes.php';


// Run app
$app->run();
exit();
