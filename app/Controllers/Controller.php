<?php

namespace App\Controllers;

class Controller
{
    public function __construct() {
        
    }

    public function redirect($page, $args = [])
    {
        $params;

        foreach ($args as $key => $value) {
            $params .= "&$key=$value";
        }
        var_dump("Location: index.php?p=$page".$params);
        header("Location: index.php?p=$page".$params);
    }

    public function render($view, $args = [])
    {
        ob_start();
        extract($args, EXTR_PREFIX_ALL, "my"); // Cree des variables du nom des elements de l'array a la volee
        require (__ROOT__ . "/app/Views/$view.php");
        $content = ob_get_clean();
        require (__ROOT__ . "/app/Views/template.php");
    }
}