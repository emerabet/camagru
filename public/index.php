<?php

define('__ROOT__', dirname(dirname(__FILE__)));

session_start();

require_once "../app/App.php";
require_once "../app/Database.php";
require_once "../app/Config.php";

require_once "../app/Controllers/Controller.php";
require_once "../app/Controllers/HomeController.php";
require_once "../app/Controllers/AuthController.php";
require_once "../app/Controllers/PhotoController.php";
require_once "../app/Controllers/UserController.php";

require_once "../app/Models/Model.php";
require_once "../app/Models/Auth.php";
require_once "../app/Models/User.php";
require_once "../app/Models/Photo.php";

$app = App\App::getInstance();
$app->getToken();

$db = $app->getDb();

$page = $_GET['p'] ?? "";

if (isset($_SESSION['user_logged']) === false)
{
    if ($page == 'login') {
        $controller = new App\Controllers\AuthController();
        $controller->index();
    }

    else if ($page == 'login.auth') {
        $controller = new App\Controllers\AuthController();
        $controller->auth();
    }

    else if ($page == 'register') {
        $controller = new App\Controllers\AuthController();
        $controller->register();
    }

    else if ($page == 'user.verify') {
        $controller = new App\Controllers\UserController();
        $controller->verify();
    }

    else if ($page == 'auth.forgot') {
        $controller = new App\Controllers\AuthController();
        $controller->forgot();
    }

    else if ($page == 'user.reset') {
        $controller = new App\Controllers\AuthController();
        $controller->reset();
    }

    else {
        $controller = new App\Controllers\HomeController();
        $controller->home();
    }
}

else if (isset($_SESSION['user_logged']) === true) 
{
    if ($page == 'logout') {
        $controller = new App\Controllers\AuthController();
        $controller->logout();
    }

    else if ($page == 'user.account') {
        $controller = new App\Controllers\UserController();
        $controller->index();
    }

    else if ($page == 'user.update') {
        $controller = new App\Controllers\UserController();
        $controller->update();
    }

    else if ($page == 'photo') {
        $controller = new App\Controllers\PhotoController();
        $controller->index();
    }

    else if ($page == 'photo.save') {
        $controller = new App\Controllers\PhotoController();
        $controller->save();
    }

    else {
        $controller = new App\Controllers\HomeController();
        $controller->home();
    }
}