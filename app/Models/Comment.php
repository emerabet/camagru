<?php

namespace App\Models;

class Comment extends Model 
{
    protected $db;

    public function __construct(\App\Database $db) {
        $this->db = $db;
    }

    public function add($content, $iduser, $idphoto)
    {
        try {
            $sql = $this->db->getPdo()->prepare(
                "INSERT INTO `comment` (`content`, `date_com`, `id_user`, `id_photo`) 
                        VALUES (:content, now(), :iduser, :idphoto)");
            $sql->bindParam(':content', $content);
            $sql->bindParam(':iduser', $iduser);
            $sql->bindParam(':idphoto', $idphoto);
            
            $sql->execute();
            return true;
        }
        catch(\PDOException $e) {
            return false;
        }
    }

    public function getByIdPhoto($id) 
    {
        try {
            $sql = $this->db->getPdo()->prepare("SELECT `comment`.`id`, `content`, DATE_FORMAT(`date_com`, '%d-%m-%Y %H:%i:%s') as `date_com`, `id_user`, `id_photo`, `user`.`name` FROM `comment` INNER JOIN `user` ON `comment`.`id_user` = `user`.`id` WHERE `id_photo` = :id ORDER BY `date_com` DESC");
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