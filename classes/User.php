<?php

namespace App;

class User
{
    protected static $db;
    protected static $columnsDB = [
        'id', 'user_name',
        'user_email', 'user_password'
    ];

    public $id;
    public $user_name;
    public $user_password;
    public $user_email;

    public function __construct( $id, $user_name, $user_password, $user_email) 
    {
        $this->id = $id;
        $this->user_name = $user_name;
        $this->user_password = $user_password;
        $this->user_email = $user_email;
    }

    protected function getLoginData($data) {
        $userData = $data;

        $this->getUser($userData);
    }

    protected function getUser($username) {
        $query = "SELECT * FROM users WHERE user_name = $username";

        return self::$db->query($query);
    }

    public static function setDB($database)
    {
        self::$db = $database;
    }
}
