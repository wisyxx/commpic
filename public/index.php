<?php
require_once __DIR__ . '../../includes/app.php';

use MVC\Router;

use Controllers\ConversationsController;
use Controllers\UserController;
use Controllers\PagesController;

$router = new Router;

/* USER (public) */
$router->get('/user/login', [UserController::class, 'login']);
$router->post('/user/login', [UserController::class, 'login']);

/* PAGES (public) */
$router->get('/conversations', [ConversationsController::class, 'conversations']);
$router->get('/', [PagesController::class, 'index']);

$router->checkRoutes();