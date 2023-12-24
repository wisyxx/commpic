<?php

namespace Model;

class Conversations extends ActiveRecord
{
   protected static $columnsDB = ['id', 'name', 'createdBy'];
   protected static $table = 'conversations';

   public $id;
   public $name;
   public $createdBy;

   public function __construct($args = [])
   {
      $this->id = $args['id'] ?? null;
      $this->name = $args['name'] ?? '';
      $this->createdBy = $args['createdBy'] ?? '';
   }
}