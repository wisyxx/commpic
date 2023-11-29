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

    /* LOGIN */
    public function login() 
    {
        if(!$this->auth()) {
            return var_dump(0);
        }
        header('Location: /topics.php');
        session_start([
            // OPTIONS
        ]);
    }

    protected function auth() {
        return $this->authMail();
    }

    protected function authMail() 
    {
        $email = $this->user_email;
        $query = "SELECT * FROM users WHERE user_email = '$email'";
        $results = self::$db->query($query)->fetch_assoc();
        // TO-DO: Errors Validation: validate if the email exists

        $password = $results['user_password'];
        return $this->authPassword($password);
    }

    protected function authPassword($hash) {
        $password = $this->user_password;
        return password_verify($password, $hash);
        // TO-DO: Errors Validation: validate if the password is correct
    }
    
    protected function hashPassword()
    {
        return password_hash($this->user_password, PASSWORD_BCRYPT);
    }

    /* VALIDATION */
    protected function validate() {
        // TO-DO
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

    public static function setDB($database)
    {
        self::$db = $database;
    }
}
