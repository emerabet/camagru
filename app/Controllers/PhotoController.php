<?php 

namespace App\Controllers;

class PhotoController extends Controller
{
    public function index()
    {
        $this->render("webcam");
    }

    private function getPathSticker($id)
    {
        if ($id == "img-hado")
            return (__ROOT__ . "/public/img/hadoken.png");
        else if ($id == "img-champ")
            return (__ROOT__ . "/public/img/champ.png");
        return null;
    }

    public function save()
    {
        $res = false;
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            http_response_code(404);
        
        if (isset($_POST['data']))
            $o = json_decode($_POST['data']);

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
                imagepng($base, __ROOT__ . "/upload/$name.png");
                imagedestroy($base);
                $app = \App\App::getInstance();
                $db = $app->getDb();
                $model = new \App\Models\Photo($db);
                $final = $name . ".png";
                $model->add($o->title, $final, $_SESSION['user_logged']['id']);
            }
        http_response_code(200);
    }
}