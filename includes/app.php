<?php 

require __DIR__ . '/../vendor/autoload.php';
require 'config/database.php';
require "functions.php";

$db = conectarDB();

use Model\ActiveRecord;

ActiveRecord::setDB($db);
?>