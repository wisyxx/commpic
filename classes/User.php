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

    public function __construct( $args = [] )
    {
        $this->id = $args['id'] ?? null;
        $this->user_name = $args['name'] ?? null;
        $this->user_password = $args['password'] ?? null;
        $this->user_email = $args['email'] ?? null;
    }

    public static function setDB($database)
    {
        self::$db = $database;
    }
}
