<?php

namespace Controllers;

use MVC\Router;
use Model\Conversations;

class ConversationsController
{
    public static function conversations(Router $router) 
    {
        session_start();

        if (!isset($_SESSION['user-name'])) {
            header('Location: /user/login');
        }

        $router->render('pages/conversations', []);
    }
}