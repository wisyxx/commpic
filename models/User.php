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
    protected function sanitizeEmail()
    {
        $email = $this->email;
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        return $email;
    }

    protected function findUserByEmail()
    {
        $query = "SELECT * FROM users WHERE email = '" . self::$db->escape_string($this->email) . "';";
        $result = self::$db->query($query)->fetch_assoc();

        return $this->createObject($result);
    }

    public function login()
    {
        $userData = $this->findUserByEmail();
        if (password_verify($this->password, $userData->password)) {
            session_start();
            $_SESSION['user-name'] = $userData->name;
            $_SESSION['user-email'] = $userData->email;

            header('Location: /conversations');
        } else if (!password_verify($this->password, $userData->password) || !$userData) {
            return $this->validate();
        }
    }

    public function validate()
    {
        $password = $this->findUserByEmail()->password;

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
        if ( // the password isnt correct, the password was writen and user exists 
            // or user doest exist and we've got a password and email
            !password_verify($this->password, $password) && $this->password && $password ||
            !$password && $this->password && $this->email
        ) {
            self::$errors[] = 'Incorrect password or email';
        }

        return self::$errors;
    }
}
