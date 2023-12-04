<?php

namespace App;

class User
{
    protected static $errors = [];
    protected static $db;
    protected static $columnsDB = [
        'id', 'name',
        'email', 'password'
    ];
    
    public $id;
    public $name;
    public $password;
    public $email;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->email = $args['email'] ?? '';
    }
    
    /* LOG IN */
    protected function sanitizeEmail()
    {
        $email = $this->email;
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        return $email;
    }

    protected function findUserByEmail() {
        $query = "SELECT * FROM users WHERE email = '" . self::$db->escape_string($this->email) . "';";
        $result = self::$db->query($query);
        
        return $result;
    }
    
    public function login() {
        $userData = $this->findUserByEmail()->fetch_assoc();
        $userData = $this->createObject($userData);
        
        if(password_verify($this->password, $userData->password)) {
            session_start([
                // OPTIONS
            ]);
        } else {
            return debug(0);
        }
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
            $this->email = '';
        }
        
        return self::$errors;
    }
    
    public static function getErrors() {
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
        // Release memory
        $result->free();

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
