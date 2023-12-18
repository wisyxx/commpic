<?php

namespace Model;

class User extends ActiveRecord
{
    protected static $errors = [];
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
    public function validate() {
        if (!$this->email) {
            self::$errors[] = 'Please, provide an email';
        }
        if (!$this->password) {
            self::$errors[] = 'Please, provide a password';
        }

        return self::$errors;
    }

    public function findUser() {
        $query = "SELECT * FROM users WHERE email = '$this->email' LIMIT 1;";
        $result = self::$db->query($query);
        
        if ($result->num_rows) {
            return [
                true,
                $result
            ];
        } else {
            self::$errors[] = 'User does not exist';
            return [
                false,
                self::$errors
            ];
        } 
    }
    public function verifyPassword($result) {
        $user = $result->fetch_assoc();
        $auth = password_verify($this->password, $user['password']);

        if ($auth) {
            session_start();

            $_SESSION['user-name'] = $user['name'];
            $_SESSION['user-email'] = $user['email'];
            return true;
        } else {
            self::$errors[] = 'Incorrect password';
            return [
                false,
                self::$errors
            ];
        }
    }
}
