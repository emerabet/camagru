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

$app = App\App::getInstance();
$app->getToken();

$db = $app->getDb();


$page = $_GET['p'] ?? "";
if ($page == 'home' || $page == "") {
    $controller = new App\Controllers\HomeController();
    $controller->home();
}

else if ($page == 'login') {
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

else if ($page == 'photo') {
    $controller = new App\Controllers\PhotoController();
    $controller->index();
}