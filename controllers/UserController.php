<?php

namespace Controllers;

use MVC\Router;
use Model\User;


class UserController
{
    public static function login(Router $router)
    {
        $user = new User;
        $errors = User::getErrors();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST['login']);
            $user->validate();

            if (empty($errors)) {
                $result = $user->findUser();
                [$exists, $result] = $result;

                if ($exists) {
                    $result = $user->verifyPassword($result);
                    [$auth] = $result;

                    /*
                    * $auth returns NULL bc $result does not have any 
                    * structure when the password is correct
                    */
                    if (is_null($auth)) {
                        return header('Location: /conversations');
                    } else {
                        $errors = $result[1]; // The error message
                    }
                } else {
                    $errors = $result;
                }
            }
        }

        $router->render('user/login', [
            'errors' => $errors,
            'user' => $user
        ]);
    }
}
