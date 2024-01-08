<?php

namespace Model;

class Conversation extends ActiveRecord
{
    protected static $errors = [];
    protected static $columnsDB = [
        'id',
        'message',
        'conversationId',
        'author',
        'creationDate'
    ];
    protected static $table = 'messages';

    public $id;
    public $message;
    public $conversationId;
    public $author;
    public $creationDate;

    public static function validate()
    {
        self::$errors = [];

        if (trim($_POST['message']) === '') {
            self::$errors[] = 'The message can\'t be empty';
        }

        return self::$errors;
    }

    public static function getMessages($id)
    {
        $query = "SELECT * FROM ";
        $query .= self::$table;
        $query .= " WHERE conversationId  = $id";

        $result = self::queryDB($query);
        return $result;
    }

    public static function getUserName($author)
    {
        $query = "SELECT name FROM users JOIN messages ON users.id = messages.author";
        $query .= " WHERE messages.author = $author";

        $result = self::$db->query($query);

        $userName = $result->fetch_assoc()['name'];

        return $userName;
    }

    public static function send()
    {
        $query = "INSERT INTO messages ";
        $query .= "(author, conversationId, message) ";
        $query .= "VALUES (";
        $query .= $_SESSION['user-id'];
        $query .= ", " . $_GET['id'];
        $query .= ", " . "'" . $_POST['message'] . "'";
        $query .= ")";

        $result = self::$db->query($query);

        return $result;
    }
}
