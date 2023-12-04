<?php

namespace App;

class User
{
    protected static $errors;
    protected static $db;
    protected static $columnsDB = [
        'id', 'user_name',
        'user_email', 'user_password'
    ];

    public $id;
    public $name;
    public $password;
    public $email;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? null;
        $this->password = $args['password'] ?? null;
        $this->email = $args['email'] ?? null;
    }

    protected function sanitizeEmail()
    {
        $email = $this->email;
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        return $email;
    }

    public function validate() {
        if ($this->email === '') {
            self::$errors[] = 'You must write an email';
        }
        if (!$this->password) {
            self::$errors[] = 'You must write a password';
        }
        if (!$this->sanitizeEmail() && $this->email !== '') {
            self::$errors[] = 'Invalid email address';
        }

        return self::$errors;
    }

    protected function queryDB($query)
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
    protected static function createObject($arr)
    {
        $obj = new self;

        foreach ($arr as $key => $value) {
            if (property_exists($obj, $key)) {
                $obj->$key = $value;
            }
        }
        return $obj;
    }

    public static function getErrors() {
        return self::$errors;
    }

    /* DB */
    public static function setDB($database)
    {
        self::$db = $database;
    }
}
