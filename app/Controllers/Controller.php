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
        $app = \App\App::getInstance();
        ob_start();
        $args['logged'] = false;
        $args['user'] = null;
        $args['title'] = $app->getTitle();
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

    protected function display_msg($msgs) {
        require (__ROOT__ . "/app/Views/msg.php");
    }

    protected function notify_comment_mail($to, $title)
    {
        $subject = "Nouveau comentaire sur votre montage";
        $message = "
        <html>
        <head>
        <title>Nouveau comentaire sur votre montage</title>
        </head>
        <body>
        <p>Un nouveau commenaire vient d'etre publié sur votre montage : $title</p>
        </body>
        </html>
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail($to, $subject, $message, $headers);
    }
}