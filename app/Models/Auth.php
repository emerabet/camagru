<?php

namespace App\Models;

class Auth extends Model
{
    public function __construct(\App\Database $database)
    {
        parent::__construct($database);
    }

    public function login($username)
    {
        try {
            $sql = $this->db->getPdo()->prepare("SELECT `id`, `name`, `email`, `password`, `verified`, `role`, `notif` FROM `user` WHERE `role` > -1 AND `name` = :name;");
            $sql->bindParam(':name', $username);
            $sql->execute();
            $res = $sql->setFetchMode(\PDO::FETCH_ASSOC);
            if ($res === true)
                return $sql->fetch();
            return false;
        }
        catch (\PDOException $e) {
            return false;
        }
        return false;
    }
}