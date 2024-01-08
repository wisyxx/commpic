<?php

namespace Controllers;

use DateTime;
use MVC\Router;
use Model\Conversations;
use Model\Conversation;


class ConversationsController
{
    public static function conversations(Router $router)
    {
        session_start();

        if (!isset($_SESSION['user-name'])) {
            header('Location: /login');
        }

        $conversations = Conversations::all();

        $router->render('conversations/index', [
            'conversations' => $conversations
        ]);
    }

    public static function conversation(Router $router)
    {
        // Check for login
        session_start();
        if (!isset($_SESSION['user-name'])) {
            header('Location: /login');
        }

        // Check for valid id
        $id = $_GET['id'];
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            header('Location: /404');
        }

        $conversation = Conversation::getMessages($id);

        /* CALCULATE DATE DIFF & SET AUTHOR NAME*/
        foreach ($conversation as $chat) {
            $date = '';

            $creationDate = new DateTime($chat->creationDate);
            $currentDate = new DateTime();

            $diff = $currentDate->diff($creationDate);

            $days = $diff->days;
            $hours = $diff->h;
            $minutes = $diff->i;

            if ($days > 31) {
                $date = "More than a month ago";
            } elseif ($days > 30) {
                $date = "One month ago";
            } elseif ($days > 21) {
                $date = "Three weeks ago";
            } elseif ($days > 14) {
                $date = "Two weeks ago";
            } elseif ($days > 7) {
                $date = "A week ago";
            } elseif ($days > 0) {
                $date = $days . ($days === 1 ? " day " : " days ") . "ago";
            } elseif ($hours > 0) {
                $date = $hours . ($hours === 1 ? " hour " : " hours ") . "ago";
            } elseif ($minutes > 0) {
                $date = $minutes . ($minutes === 1 ? " minute " : " minutes ") . "ago";
            } else {
                $date = "Right now";
            }
            // Set date stamp
            $chat->creationDate = $date;

            // Set author name
            $chat->author = Conversation::getUserName($chat->author);
        }

        /* SEND MESSAGES */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Conversation::send();
            header("refresh:0");
        }

        $router->render('conversations/conversation', [
            'conversation' => $conversation
        ]);
    }
}
