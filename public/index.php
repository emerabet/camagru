<?php

define('__ROOT__', dirname(dirname(__FILE__)));

require_once "../app/App.php";
require_once "../app/Database.php";
require_once "../app/Config.php";

require_once "../app/Controllers/Controller.php";
require_once "../app/Controllers/HomeController.php";
require_once "../app/Controllers/AuthController.php";

require_once "../app/Models/Model.php";
require_once "../app/Models/Auth.php";

$app = App\App::getInstance();

$db = $app->getDb();

var_dump($db->getPdo());


$page = $_GET['p'] ?? "";

if ($page == 'home' || $page == "") {
    $controller = new App\Controllers\HomeController();
    $controller->home();
}

else if ($page == 'login') {
    $controller = new App\Controllers\AuthController();
    $controller->auth();
}