<?php

define('__ROOT__', dirname(__FILE__));

session_start();

require_once "app/App.php";
require_once "app/Database.php";
require_once "app/Config.php";

require_once "app/Controllers/Controller.php";
require_once "app/Controllers/HomeController.php";
require_once "app/Controllers/AuthController.php";
require_once "app/Controllers/PhotoController.php";
require_once "app/Controllers/UserController.php";

require_once "app/Models/Model.php";
require_once "app/Models/Auth.php";
require_once "app/Models/User.php";
require_once "app/Models/Photo.php";
require_once "app/Models/Comment.php";
require_once "app/Models/Like.php";

$app = App\App::getInstance();
$app->getToken();
$db = $app->getDb();

$page = $_GET['p'] ?? "";
if ($page == "" || $page == "home") {
    $app->setTitle("Gallerie");
    $controller = new App\Controllers\HomeController();
    $controller->home();
}

else if ($page == "home.gallery") {
    $controller = new App\Controllers\PhotoController();
    $controller->all();
}

else if ($page == "send.comment") {
    $controller = new App\Controllers\PhotoController();
    $controller->sendcomment();
}

else if ($page == "upvote") {
    $controller = new App\Controllers\PhotoController();
    $controller->upvote();
}

else if ($page == "photo.show") {
    $controller = new App\Controllers\PhotoController();
    $controller->show();
}

else if (isset($_SESSION['user_logged']) === false)
{
    if ($page == 'login') {
        $app->setTitle("Connexion");
        $controller = new App\Controllers\AuthController();
        $controller->index();
    }

    else if ($page == 'login.auth') {
        $controller = new App\Controllers\AuthController();
        $controller->auth();
    }

    else if ($page == 'register') {
        $app->setTitle("Inscription");
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

    else if ($page == 'photo.del') {
        echo "Il est nécessaire de se connecter pour effectuer cette action";
    }

    else {
        echo "Not Found";
        http_response_code(404);
    }
}

else if (isset($_SESSION['user_logged']) === true) 
{
    if ($page == 'logout') {
        $controller = new App\Controllers\AuthController();
        $controller->logout();
    }

    else if ($page == 'user.account') {
        $app->setTitle("Mon compte");
        $controller = new App\Controllers\UserController();
        $controller->index();
    }

    else if ($page == 'user.update') {
        $controller = new App\Controllers\UserController();
        $controller->update();
    }

    else if ($page == 'photo') {
        $app->setTitle("Montage photo");
        $controller = new App\Controllers\PhotoController();
        $controller->index();
    }

    else if ($page == 'photo.save') {
        $controller = new App\Controllers\PhotoController();
        $controller->save();
    }

    else if ($page == 'photo.user') {
        $controller = new App\Controllers\PhotoController();
        $controller->load();
    }

    else if ($page == 'photo.del') {
        $controller = new App\Controllers\PhotoController();
        $controller->del();
    }

    else {
        echo "Not Found";
        http_response_code(404);
    }
}
else {
    echo "Not Found";
    http_response_code(404);
}