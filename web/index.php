<?php

use app\controllers\UserController;
use core\App;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require dirname(__DIR__) . '/vendor/autoload.php';


$config = array_merge(
    require dirname(__DIR__) . '/app/config/main.php',
    require dirname(__DIR__) . '/app/config/main-local.php'
);


$app = new App(dirname(__DIR__), $config);

$app->router->get('/user', [ UserController::class, 'index']);
$app->router->get('/user/create', [ UserController::class, 'create']);
$app->router->post('/user/create', [ UserController::class, 'create']);
$app->router->get('/user/update', [ UserController::class, 'update']);
$app->router->post('/user/update', [ UserController::class, 'update']);
$app->router->get('/user/delete', [ UserController::class, 'delete']);


$app->run();
