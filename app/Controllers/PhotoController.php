<?php 

namespace App\Controllers;

class PhotoController extends Controller
{
    public function index()
    {
        $this->render("webcam");
    }

    public function show()
    {
        $app = \App\App::getInstance();
        $db = $app->getDb();
        $model = new \App\Models\Photo($db);
        $args = [];

        $id = $_GET['id'] ?? "";
        if (is_numeric($id)) {
            $res = $model->getByPhotoId($id);
            $com = new \App\Models\Comment($db);
            $msg = $com->getByIdPhoto($id);
            $app->setTitle($res['title']);
            $args['res'] = $res;
            $args['comments'] = $msg;
            $args['token'] = $app->refreshToken();
        }
        $this->render("photo", $args);
    }

    private function getPathSticker($id)
    {
        if ($id == "img-hado")
            return (__ROOT__ . "/img/hadoken.png");
        else if ($id == "img-champ")
            return (__ROOT__ . "/img/champ.png");
        else if ($id == "img-coca")
            return (__ROOT__ . "/img/coca.png");
        else if ($id == "img-kebab")
            return (__ROOT__ . "/img/kebab.png");
        else if ($id == "img-worldcup")
            return (__ROOT__ . "/img/worldcup.png");
        else if ($id == "img-lunette")
            return (__ROOT__ . "/img/lunette.png");
        return null;
    }

    private function check($o)
    {
        $errors = [];

        $title = $o->title ?? "";

        if ($title == "")
            $errors[] = "Titre manquant";
        
        if (isset($o->itms) === false || count($o->itms) === 0)
            $errors[] = "Aucun sticker trouve";

        return $errors;
    }

    public function save()
    {
        $res = false;
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            http_response_code(404);
        
        if (isset($_POST['data'])) 
        {
            $o = json_decode($_POST['data']);
            $errors = $this->check($o);
            if (count($errors) > 0)
                http_response_code(404);

            $str = str_replace('data:image/png;base64,', '', $o->img);
            $str = str_replace(' ', '+', $str);
            $name = bin2hex(random_bytes(16));

            $im = imagecreatefromstring(base64_decode($str));
            if ($im !== false) 
            {
                imagedestroy($im);
                $path = __ROOT__ . "/upload/$name.png";
                file_put_contents($path, base64_decode($str));
                list($width, $height) = getimagesize($path);
                $base = imagecreatefrompng($path);
                foreach ($o->itms as $key => $value) {
                    $f = $this->getPathSticker($value->id);
                    if ($f !== null) {
                        $itm = imagecreatefrompng($f);
                        $itm_resized = imagecreatetruecolor($value->width, $value->height);
                        imagealphablending($itm_resized, false);
                        imagesavealpha($itm_resized, true);
                        $transparent = imagecolorallocatealpha($itm_resized, 255, 255, 255, 127);
                        imagefilledrectangle($itm_resized, 0, 0, $value->width, $value->height, $transparent);
                        list($original_w, $original_h) = getimagesize($f);
                        imagecopyresampled($itm_resized, $itm, 0, 0, 0, 0, $value->width, $value->height, $original_w, $original_h);
                        imagecopy($base, $itm_resized, $value->left, $value->top, 0, 0, $value->width, $value->height);
                        imagedestroy($itm_resized);
                        imagedestroy($itm);
                    }
                }
                imagealphablending($base, false);
                imagesavealpha($base, true);
                imagepng($base, __ROOT__ . "/upload/$name.png");
                imagedestroy($base);
                $app = \App\App::getInstance();
                $db = $app->getDb();
                $model = new \App\Models\Photo($db);
                $final = $name . ".png";
                $model->add($o->title, $final, $_SESSION['user_logged']['id']);
                $errors[] = "Image sauvegardée";
                $this->display_msg($errors);
                http_response_code(200);
            }
            else
            {
                imagedestroy($im);
                $errors[] = "Image incorrecte";
                $this->display_msg($errors);
                http_response_code(406);
            }
        }
    }

    private function check_comment($obj, $token) 
    {
        $errors = [];
        
        if ($obj->iduser != $_SESSION['user_logged']['id'])
            $errors[] = "Utiliateur incoherent";
        if (strlen($obj->comment) <= 0)
            $errors[] = "Commentaire trop court";
        if (hash_equals($token, $obj->token) === false)
            $errors[] = "Token incoherent";

        return $errors;
    }

    public function sendcomment()
    {
        $res = false;
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            http_response_code(404);

        if (isset($_POST['data'])) 
        {
            $app = \App\App::getInstance();

            $o = json_decode($_POST['data']);
            $errors = $this->check_comment($o, $app->getToken());
            if (count($errors) > 0)
                http_response_code(404);

            $db = $app->getDb();
            $model = new \App\Models\Comment($db);
            $res = $model->add($o->comment, $o->iduser, $o->idphoto);
            if ($res !== false) {
                echo "Envoyé";
                $model = new \App\Models\Photo($db);
                $author = $model->getByPhotoId($o->idphoto);
                if ($author !== false && $author['notif'] == "1")
                    $this->notify_comment_mail($author['email'], $author['title']);
                http_response_code(200);
            }
            else {
                echo "Le commentaire n'a pas pu etre posté";
                http_response_code(406);
            }
        }
        else {
            echo "Le commentaire n'a pas pu etre posté";
            http_response_code(406);
        }
    }

    public function load($id = -1)
    {
        $res = false;
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            http_response_code(404);

        if ($id === -1) {
            $id = $_SESSION['user_logged']['id'];
        }

        $app = \App\App::getInstance();
        $db = $app->getDb();
        $model = new \App\Models\Photo($db);
        $res = $model->getByUserId($id);

        if ($res !== false) {
            echo json_encode($res);
            http_response_code(200);
        }
        else
            http_response_code(406);
    }

    public function all() {
        $res = false;
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            http_response_code(404);

        $app = \App\App::getInstance();
        $db = $app->getDb();
        $model = new \App\Models\Photo($db);

        $count = $model->getNbPhotos();
        $nb = 9;
        $pages = ceil($count / $nb);

        $current = 1;
        if (isset($_GET['from']) === true &&$_GET['from'] > 0 && $_GET['from'] <= $pages)
            $current = $_GET['from'];

        $ask = ($current - 1) * $nb;

        $res = $model->getPage($ask, $nb);
        $final = [];
        if ($res !== false) {
            $final = ["total" => $pages, "page" => $current, "rowCount" => $count, "rows" => $res];
            echo json_encode($final);
            http_response_code(200);
        }
        else {
            http_response_code(406);
        }
    }

    public function upvote()
    {
        $res = false;
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            http_response_code(404);

        if (isset($_POST['data'])) 
        {
            $app = \App\App::getInstance();
            $db = $app->getDb();
            $model = new \App\Models\Like($db);
            $res = false;

            $o = json_decode($_POST['data']);
    
            $iduser = $_SESSION['user_logged']['id'];
            $count = $model->isLiked($iduser, $o->id);
            $action = "Liked";

            if ($count == 0) {
                $res = $model->add($iduser, $o->id);
            }
            else {
                $res = $model->del($iduser, $o->id);
                $action = "Like enlevé";
            }
            
            if ($res !== false) {
                echo $action;
                if ($action == "Liked")
                    http_response_code(200);
                else {
                    http_response_code(202);
                }
            }
            else {
                echo "Aucune action effectueée";
                http_response_code(406);
            }
        }
        else {
            echo "Aucune action effectueée";
            http_response_code(406);
        }
    }

    public function del()
    {
        $res = false;
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            http_response_code(404);

        if (isset($_POST['data'])) 
        {
            $app = \App\App::getInstance();
            $db = $app->getDb();
            $model = new \App\Models\Photo($db);
            $res = false;

            $o = json_decode($_POST['data']);
        
            $iduser = $_SESSION['user_logged']['id'];
            $idusercookie = $_COOKIE['user_logged'] ?? "";

            if ($idusercookie != "")
                $idusercookie = json_decode($idusercookie);

            if ($idusercookie != "" && $iduser == $idusercookie->id)
            {
                $tmp = $model->getByPhotoId($o->id);
                $res = $model->delPhoto($iduser, $o->id);              
                if ($res !== false) {
                    $name = $tmp['name'];
                    $path = __ROOT__ . "/upload/$name";
                    unlink($path);
                    echo "Supprimée";
                    http_response_code(200);
                }
                else {
                    echo "Aucune action effectuée";
                    http_response_code(406);
                }
            }
            else {
                echo "Aucune action effectuée";
                http_response_code(403);
            }
        }
        else {
            echo "Aucune action effectuée";
            http_response_code(406);
        }
    }
}