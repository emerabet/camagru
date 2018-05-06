<?php

namespace App;

use PDO;

class Database {

    private $pdo;

    private $user;
    private $pwd;
    private $db;
    private $host;

    public function __construct($db_name, $db_user, $db_pass, $db_host)
    {
        $this->db = $db_name;
        $this->user = $db_user;
        $this->pwd = $db_pass;
        $this->host = $db_host;
    }

    public function getPdo()
    {
        if ($this->pdo === null)
        {
            try {
                $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pwd); 
            }
            catch (\PDOException $e) {
                throw new \Exception('Could not connect to database');
            }
        }
        return $this->pdo;
    }

}