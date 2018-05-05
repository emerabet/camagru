<?php 

namespace App\Controllers;

class AuthController extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function auth() 
    {
        $app = \App\App::getInstance();
        $db = $app->getDb();
        $model = new \App\Models\Auth($db);

        var_dump($model);
    }
}