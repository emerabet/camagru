<?php

namespace App\Models;

class Photo extends Model
{
    public function add($title, $name, $id_user)
    {
        try {
            $sql = $this->db->getPdo()->prepare(
                "INSERT INTO `photo` (`title`, `name`, `created`, `id_user`) 
                            VALUES (:title, :name, now(), :iduser)");
            $sql->bindParam(':name', $name);
            $sql->bindParam(':title', $title);
            $sql->bindParam(':iduser', $id_user);
            
            $sql->execute();
            return true;
        }
        catch(\PDOException $e) {
            return false;
        }
    }

    public function getByUserId($id)
    {
        try {
            $sql = $this->db->getPdo()->prepare("SELECT `id`, `title`, `name`, `created` FROM `photo` WHERE `id` = :id");
            $sql->bindParam(':id', $id);
            
            $sql->execute();
            $res = $sql->setFetchMode(\PDO::FETCH_ASSOC);
            if ($res === true)
                return $sql->fetchAll();
            return false;
        }
        catch (\PDOException $e) {
            return false;
        }
    }
}