<?php

namespace App\Models;

class Photo extends Model
{
    public function add($title, $name, $id_user)
    {
        echo $name;
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
            var_dump($e);
            return false;
        }
    }
}