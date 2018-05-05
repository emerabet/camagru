<?php

namespace App\Controllers;

class Controller
{
    public function __construct() {
        
    }

    public function render($view)
    {
        ob_start();
        $test = "ma values";
        require (__ROOT__ . "/app/Views/home.php");
        $content = ob_get_clean();
        require (__ROOT__ . "/app/Views/template.php");
    }
}