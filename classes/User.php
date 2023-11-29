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

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->user_name = $args['name'] ?? null;
        $this->user_password = $args['password'] ?? null;
        $this->user_email = $args['email'] ?? null;
    }

    public function login() 
    {
        $this->auth();
    }

    protected function auth() {
        $this->authMail();
    }

    protected function authMail() 
    {
        $email = $this->user_email;
        $query = "SELECT * FROM users WHERE user_email = '$email'";
        $results = self::$db->query($query);
        
        if (!$results->fetch_assoc()) {
            return 0; // TO-DO: Errors Validation: validate if the email exists
        }
        return 'Now auth password'; // TO-DO: Create authentication for the password
                                    // TO-DO: Create methods to encript and decript password
    }

    public function queryDB($query)
    {
        $result = self::$db->query($query);

        $objectsArr = [];

        /* 
        *   $arr stores the DB row queried with $result so when there's 
        *   no more rows $arr = null and the loop ends
        */
        while ($arr = $result->fetch_assoc()) {
            $objectsArr[] = $this->createObject($arr);
        }

        return $objectsArr;
    }

    protected function createObject($arr)
    {
        $obj = new self;

        foreach ($arr as $key => $value) {
            if (property_exists($obj, $key)) {
                $obj->$key = $value;
            }
        }
        return $obj;
    }

    protected function hashPassword()
    {
        return password_hash($this->user_password, PASSWORD_BCRYPT);
    }

    public static function setDB($database)
    {
        self::$db = $database;
    }
}
