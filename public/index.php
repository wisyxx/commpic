<?php
require_once __DIR__ . '../../includes/app.php';

use MVC\Router;

use Controllers\ConversationsController;
use Controllers\PagesController;
use Controllers\AccountController;

$router = new Router;

/* USER */
$router->get('/login', [AccountController::class, 'login']);
$router->post('/login', [AccountController::class, 'login']);
$router->get('/logout', [AccountController::class, 'logout']);

/* PAGES */
$router->get('/', [PagesController::class, 'index']);
$router->get('/404', [PagesController::class, 'pageNotFound']);

/* CONVERSATIONS */
$id = $_GET['id'] ?? null;
$router->get('/conversations', [ConversationsController::class, 'conversations']);
$router->get("/conversation", [ConversationsController::class, 'conversation']);
$router->post("/conversation", [ConversationsController::class, 'conversation']);

$router->checkRoutes();