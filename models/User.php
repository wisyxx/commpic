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
}
