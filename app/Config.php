<?php

namespace App;

class Config {

    private $settings = [];
    private static $_instance;

    public function __construct()
    {
        require_once __ROOT__ . '/config/database.php';
        $this->settings = [
            "db_dsn" => $DB_DSN, 
            "db_user" => $DB_USER, 
            "db_pwd" => $DB_PASSWORD
        ];
    }

    // Singleton
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Config();
        }
        return self::$_instance;
    }

    public function get($key)
    {
        if (isset($this->settings[$key]) === false)
            return null;
        return $this->settings[$key];
    }

    
}