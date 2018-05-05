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
            echo "X";
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
                $config->get("db_name"), 
                $config->get("db_user"), 
                $config->get("db_pwd"), 
                $config->get("db_host")
            );
        }
        return $this->db_instance;
    }

}