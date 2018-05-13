<?php 

namespace App\Controllers;

class UserController extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function index($args = [])
    {
        $app = \App\App::getInstance();
        $args['token'] = $app->refreshToken();
        $this->render('account', $args);
    }

    public function update()
    {
        $args = [];
        $errors = [];

        $app = \App\App::getInstance();
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $chk = false;
            $user = $_SESSION['user_logged'];

            $pwd1 = $_POST['password'] ?? "";
            $pwd2 = $_POST['confirmpwd'] ?? "";
            $email = $_POST['email'] ?? "";
            $username = $_POST['pseudo'] ?? "";
            if (isset($_POST['chk']))
                $chk = true;

            if ($chk === true && ($pwd1 == "" || $pwd2 == ""))
                $errors[] = "Mot de passe incorrect";
            if ($this->check_password_strength($pwd1) === false)
                $errors[] = "Pattern du mot de passe incorrect";
            if ($email == "" || $username == "")
                $errors[] = "Email et Pseudo ne peuvent pas etre vides.";
            
            if (count($errors) === 0)
            {
                $db = $app->getDb();
                $model = new \App\Models\User($db);

                $id = $user['id'];
                $user['email'] = $email;
                $user['name'] = $username;
                if ($chk === true)
                {
                    $pass = password_hash($pwd1, PASSWORD_DEFAULT);
                    $user['password'] = $pass;
                }

                $count = $model->edit($user, $id);
                if ($count > 0) {
                    $args["verif"] = "OK";
                    unset($user['password']);
                    $_SESSION['user_logged'] = $user;
                    $this->index($args);
                }
            }
        }
    }

    public function verify()
    {
        $app = \App\App::getInstance();
        $args = [];
        $errors = [];

        $args["verif"] = "KO";
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['key']))
        {
            $db = $app->getDb();
            $model = new \App\Models\User($db);
            $res = $model->find_by_verification_key($_GET['key']);
            if ($res !== false)
            {
                $id = $res['id'];
                $res['role'] = 1;
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