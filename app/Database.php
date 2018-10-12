<?php

namespace App;

use PDO;

class Database {

    private $pdo;

    private $dsn;
    private $user;
    private $pwd;

    public function __construct($db_dsn, $db_user, $db_pass)
    {
        $this->user = $db_user;
        $this->pwd = $db_pass;
        $this->dsn = $db_dsn;
    }

    public function getPdo()
    {
        if ($this->pdo === null)
        {
            try {
                $this->pdo = new PDO($this->dsn, $this->user, $this->pwd); 
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (\PDOException $e) {
                throw new \Exception('Could not connect to database');
            }
        }
        return $this->pdo;
    }

    public function getPdoInstall()
    {
        if ($this->pdo === null)
        {
            try {
                $dsn = explode(";", $this->dsn);
                $this->pdo = new PDO("mysql:;$dsn[1]", $this->user, $this->pwd);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (\PDOException $e) {
                throw new \Exception('Could not connect to database');
            }
        }
        return $this->pdo;
    }

}