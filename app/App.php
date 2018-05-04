<?php

namespace App;

class App {

    private static $_instance;
    

    public function __construct()
    {

    }

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    public function getDb()
    {
        if (self::$db === null) {
            self::$db = new Database();
        }
        return self::$db;
    }

}