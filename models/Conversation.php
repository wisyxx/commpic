<?php

namespace Model;

class Conversation extends ActiveRecord
{
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

    public static function getMessages($id)
    {
        $query = "SELECT * FROM ";
        $query .= self::$table;
        $query .= " WHERE conversationId  = $id";

        $result = self::queryDB($query);

        return $result;
    }

    public static function getUserName($author) {
        $query = "SELECT name FROM users JOIN messages ON users.id = messages.author";
        $query .= " WHERE messages.author = $author";

        $result = self::$db->query($query);

        $userName = $result->fetch_assoc()['name'];
        
        return $userName;
    }
}
