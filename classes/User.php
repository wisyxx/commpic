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

    public static function sanitizeEmail($post)
    {
        $post['email'] = filter_var($post['email'], FILTER_VALIDATE_EMAIL);
        if (!$post['email']) {
            header('Location: /login.php');
        }
        return self::createObject($post);
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

    /* DB */
    public static function setDB($database)
    {
        self::$db = $database;
    }
}
