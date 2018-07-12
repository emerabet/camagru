<?php

namespace App;

class App {

    private static $_instance;
    private $db_instance;

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
        $config = Config::getInstance();
        if ($this->db_instance === null) 
        {
            $this->db_instance = new Database(
                $config->get("db_dsn"), 
                $config->get("db_user"), 
                $config->get("db_pwd")
            );
        }
        return $this->db_instance;
    }

    public function getToken()
    {
        if (!isset($_SESSION['token'])) {
            $_SESSION['token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['token'];
    }

    public function refreshToken()
    {
        unset($_SESSION['token']);
        return $this->getToken();
    }
}