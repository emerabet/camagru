<?php

namespace App\Controllers;

class Controller
{
    public function __construct() {
        
    }

    public function render($view)
    {
        ob_start();
        require (__ROOT__ . "/app/Views/$view.php");
        $content = ob_get_clean();
        require (__ROOT__ . "/app/Views/template.php");
    }
}