<?php 

namespace App\Controllers;

class UserController extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function verify()
    {
        var_dump($_GET);
        $app = \App\App::getInstance();
        $args = [];
        $errors = [];

        $db = $app->getDb();
        $model = new \App\Models\User($db);

        $args["verif"] = "KO";
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['key']))
        {
            $res = $model->find_by_verification_key($_GET['key']);
            if ($res !== false)
            {
                $id = $res['id'];
                $res['verified'] = "OK";
                unset($res['id']);
                $count = $model->edit($res, $id);
                if ($count > 0) {
                    $args["verif"] = "OK";
                }
            }
        }
        $this->redirect('login', $args);
    }
}