<?php

require_once '../config.php';

class Connect
{
    protected static function connect(){
        return new PDO('mysql:host='.DB_HOSTNAME.';port='.DB_PORT.';dbname='.DB_NAME,DB_USERNAME,DB_PASSWORD);
    }
}