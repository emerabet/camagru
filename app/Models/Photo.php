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
            $sql = $this->db->getPdo()->prepare("SELECT `photo`.`id`, `title`, `photo`.`name`, `created`, COUNT(`comment`.`id`) as nb_comment, COUNT(`upvote`.`id_photo`) as nb_upvote, `user`.`name` as username, `user`.`email`, `user`.`notif` 
                                                FROM `photo`
                                                INNER JOIN`user` ON `photo`.`id_user` = `user`.`id`
                                                LEFT OUTER JOIN `comment` ON `photo`.`id` = `comment`.`id_photo` 
                                                LEFT OUTER JOIN `upvote` ON `photo`.`id` = `upvote`.`id_photo` 
                                                WHERE `photo`.`id_user` = :iduser 
                                                GROUP BY `photo`.`id` 
                                                ORDER BY `created` DESC");
            $sql->bindParam(':iduser', $id);
            
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

    public function getByPhotoId($id)
    {
        try {
            $sql = $this->db->getPdo()->prepare("SELECT `photo`.`id`, `title`, `photo`.`name`, `created`, COUNT(`comment`.`id`) as nb_comment, COUNT(`upvote`.`id_photo`) as nb_upvote, `user`.`name` as username, `user`.`email`, `user`.`notif` 
                                                FROM `photo`
                                                INNER JOIN`user` ON `photo`.`id_user` = `user`.`id`
                                                LEFT OUTER JOIN `comment` ON `photo`.`id` = `comment`.`id_photo` 
                                                LEFT OUTER JOIN `upvote` ON `photo`.`id` = `upvote`.`id_photo`
                                                WHERE `photo`.`id` = :idphoto 
                                                GROUP BY `photo`.`id`;");
            $sql->bindParam(':idphoto', $id);
            
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

    public function getAll()
    {
        try {
            $sql = $this->db->getPdo()->prepare("SELECT `photo`.`id`, `title`, `name`, `created`, COUNT(`comment`.`id`) as nb_comment, COUNT(`upvote`.`id_photo`) as nb_upvote
                                                    FROM `photo`
                                                    LEFT OUTER JOIN `comment` ON `photo`.`id` = `comment`.`id_photo` 
                                                    LEFT OUTER JOIN `upvote` ON `photo`.`id` = `upvote`.`id_photo` 
                                                    GROUP BY `photo`.`id`
                                                    ORDER BY `created` DESC");

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

    public function getPage($page, $nb)
    {
        try {
            $sql = $this->db->getPdo()->prepare("SELECT `photo`.`id`, `title`, `name`, `created`, COUNT(`comment`.`id`) as nb_comment, COUNT(DISTINCT(`upvote`.`id_user`)) as nb_upvote, photo.id_user 
                                                FROM `photo`
                                                LEFT OUTER JOIN `comment` ON `photo`.`id` = `comment`.`id_photo` 
                                                LEFT OUTER JOIN `upvote` ON `photo`.`id` = `upvote`.`id_photo` 
                                                GROUP BY `photo`.`id`
                                                ORDER BY `created` DESC LIMIT :p, :nb");
            $sql->bindParam(':p', $page, \PDO::PARAM_INT);
            $sql->bindParam(':nb', $nb, \PDO::PARAM_INT);

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

    public function delPhoto($iduser, $idphoto)
    {
        try {
            $sql = $this->db->getPdo()->prepare("DELETE FROM `photo` WHERE id = :idphoto AND id_user = :iduser");
            $sql->bindParam(':idphoto', $idphoto, \PDO::PARAM_INT);
            $sql->bindParam(':iduser', $iduser, \PDO::PARAM_INT);

            $sql->execute();

            $heu = $sql->rowCount();
            if ($heu > 0){
                return true;
            }
            return false;
        }
        catch (\PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    public function getNbPhotos()
    {
        return $this->countRows('photo');
    }
}