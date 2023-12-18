<?php

namespace Model;

class ActiveRecord 
{
    protected static $db;

    public static function getErrors()
    {
        return static::$errors;
    }

    protected function atributes()
    {
        $atributes = [];
        foreach (static::$columnsDB as $column) {
            if ($column === 'id') continue;
            $atributes[$column] = $this->$column;
        }

        return $atributes;
    }

    protected function sanitizeAtributes()
    {
        $atributes = $this->atributes();

        $sanitized = [];
        foreach ($atributes as $key => $value) {
            $sanitized[$key] = self::$db->escape_string($value);
        }

        return $sanitized;
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
        $obj = new static;

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