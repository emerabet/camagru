<?php 

namespace App\Controllers;

class AuthController extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->render('login');
    }

    public function auth() 
    {
        $app = \App\App::getInstance();
        $db = $app->getDb();
        $model = new \App\Models\Auth($db);

       // var_dump($model);
    }

    public function register()
    {
        $this->render("register");
    }

    public function logout()
    {

    }
}