<?php

namespace App;

class Config {

    private $settings = [];
    private static $_instance;


    public function __construct()
    {
        $this->settings = require __ROOT__ . '/config/config.php';
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