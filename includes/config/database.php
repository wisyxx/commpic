<?php

function conectarDB(): mysqli
{
    $db = new mysqli('localhost', 'root', '177068', 'commpic_crud');

    if (!$db) {
        echo '❌ERROR: Couldn\'t connect';
        exit;
    }

    return $db;
}
