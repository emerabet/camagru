<?php

namespace App\Controllers;

class Controller
{
    public function __construct() {
        
    }

    public function redirect($page, $args = [])
    {
        $params = null;

        foreach ($args as $key => $value) {
            $params .= "&$key=$value";
        }
        header("Location: index.php?p=$page".$params);
    }

    public function render($view, $args = [])
    {
        ob_start();
        $args['logged'] = false;
        $args['user'] = null;
        if (isset($_SESSION['user_logged']))
        {
            $args['logged'] = true;
            $args['user'] = $_SESSION['user_logged'];
        }
        extract($args, EXTR_PREFIX_ALL, "my"); // Cree des variables du nom des elements de l'array a la volee
        require (__ROOT__ . "/app/Views/$view.php");
        $content = ob_get_clean();
        $loadjs = null;
        require (__ROOT__ . "/app/Views/template.php");
    }

    protected function check_password_strength($password)
    {
        if (preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/', $password) > 0)
            return true;
        return false;
    }

    protected function display_msg($errors) {
        require (__ROOT__ . "/app/Views/msg.php");
    }
}