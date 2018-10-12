<?php

namespace App\Models;

class Like extends Model 
{
    protected $db;

    public function __construct(\App\Database $db) {
        $this->db = $db;
    }

    public function isLiked($iduser, $idphoto) 
    {
        try {
            $sql = $this->db->getPdo()->prepare("SELECT COUNT(*) as `is_liked` FROM `upvote` WHERE `id_photo` = :idphoto AND `id_user` = :iduser;");
            $sql->bindParam(':iduser', $iduser);
            $sql->bindParam(':idphoto', $idphoto);
            
            $sql->execute();
            $res = $sql->setFetchMode(\PDO::FETCH_ASSOC);
            if ($res === true)
                return $sql->fetchColumn();
            return false;
        }
        catch (\PDOException $e) {
            return false;
        }
    }

    public function add($iduser, $idphoto) 
    {
        try {
            $sql = $this->db->getPdo()->prepare("INSERT INTO `upvote` (`id_user`, `id_photo`) VALUES (:iduser, :idphoto)");
            $sql->bindParam(':iduser', $iduser);
            $sql->bindParam(':idphoto', $idphoto);
            
            $sql->execute();
            return true;
        }
        catch(\PDOException $e) {
            return false;
        }
    }

    public function del($iduser, $idphoto) 
    {
        try {
            $sql = $this->db->getPdo()->prepare("DELETE FROM `upvote` WHERE id_user = :iduser AND id_photo = :idphoto;");
            $sql->bindParam(':iduser', $iduser);
            $sql->bindParam(':idphoto', $idphoto);
            
            $sql->execute();
            return true;
        }
        catch(\PDOException $e) {
            return false;
        }
    }
}