<?php
require_once __DIR__ . '../../includes/app.php';

use MVC\Router;

use Controllers\ConversationsController;
use Controllers\PagesController;
use Controllers\AccountController;

$router = new Router;

/* USER (public) */
$router->get('/login', [AccountController::class, 'login']);
$router->post('/login', [AccountController::class, 'login']);
$router->get('/logout', [AccountController::class, 'logout']);

/* PAGES (public) */
$router->get('/conversations', [ConversationsController::class, 'conversations']);
$router->get('/', [PagesController::class, 'index']);

$router->checkRoutes();