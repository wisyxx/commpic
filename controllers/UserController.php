<?php

namespace Controllers;

use MVC\Router;
use Model\User;

class UserController
{
    public static function login(Router $router) {
        $errors = User::getErrors();
        $user = new User;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST['login']);
            $errors = $user->validate();
            if (empty($errors)) {
                $user->login();
            }
        }

        $router->render('user/login', [
            'user' => $user,
            'errors' => $errors
        ]);
    }
}