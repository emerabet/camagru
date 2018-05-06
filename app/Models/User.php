<?php

namespace App\Models;

use PDO;

class User extends Model
{
    public function __construct(\App\Database $database)
    {
        parent::__construct($database);
    }

    public function add($username, $mail, $password, $verif)
    {
        try {
            $sql = $this->db->getPdo()->prepare(
                "INSERT INTO `user` (`name`, `email`, `password`, `verified`, `role`) 
                            VALUES (:name, :email, :password, :verified, 2)");
            $sql->bindParam(':name', $username);
            $sql->bindParam(':email', $mail);
            $sql->bindParam(':password', $password);
            $sql->bindParam(':verified', $verif);
            
            $sql->execute();
            return true;
        }
        catch(\PDOException $e) {
            return false;
        }
    }

    public function find_by_verification_key($key)
    {
        try {
            $sql = $this->db->getPdo()->prepare("SELECT `id`, `name`, `email`, `verified`, `role` FROM `user` WHERE `verified` = :verified");
            $sql->bindParam(':verified', $key);
            $sql->execute();
            $res = $sql->setFetchMode(\PDO::FETCH_ASSOC);
            if ($res === true)
                return $sql->fetch();
            return false;
        }
        catch (\PDOException $e) {
            return false;
        }
    }

    public function edit($args, $id)
    {
        try {
            $req = "UPDATE `user` SET ";
            foreach ($args as $key => $value) {
                $req .= "$key = :$key,";
            }
            $req = substr($req, 0, -1);
            $req .= " WHERE `id` = :id;";
            $sql = $this->db->getPdo()->prepare($req);
            foreach ($args as $key => $value) {
                $sql->bindValue(":$key", $value);
            }
            $sql->bindParam(':id', $id);
            $sql->execute();
            return $sql->rowCount();
        }
        catch (\PDOException $e) {
            var_dump($e);
            return false;
        }
    }
}