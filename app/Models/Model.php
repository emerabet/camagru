<?php

namespace App\Models;

class Model 
{
    protected $db;

    public function __construct(\App\Database $db) {
        $this->db = $db;
    }

    protected function countRows($table)
    {
        try {
            $sql = $this->db->getPdo()->prepare("SELECT COUNT(`id`) as nb FROM $table");
            
            $sql->execute();
            $res = $sql->setFetchMode(\PDO::FETCH_ASSOC);
            if ($res === true)
                return $sql->fetchColumn();
            return false;
        }
        catch (\PDOException $e) {
            var_dump($e);
            return false;
        }
    }
   
}