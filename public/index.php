<?php

define('__ROOT__', dirname(dirname(__FILE__)));

require_once "../app/Config.php";
require_once "../app/Controllers/Controller.php";
require_once "../app/Controllers/HomeController.php";

$config = new App\Config();


$page = $_GET['p'] ?? "";

if ($page == 'home' || $page == "") {
    $controller = new App\Controllers\HomeController();
    $controller->home();
}




var_dump($config);