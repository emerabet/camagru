<?php 

namespace App\Controllers;

class AuthController extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $args = [];
        $verif = $_GET['verif'] ?? "";
        if ($verif == "OK" || $verif == "KO")
            $args['verif'] = $verif;
        $this->render('login', $args);
    }

    public function auth() 
    {
        var_dump($_POST);
      /*  $app = \App\App::getInstance();
        $db = $app->getDb();
        $model = new \App\Models\Auth($db);*/

       // var_dump($model);
    }

    public function register()
    {
        $app = \App\App::getInstance();
        $args = [];
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $db = $app->getDb();
            $model = new \App\Models\User($db);

            $value = $_POST["submit"] ?? "";
            $token = $_POST['token'] ?? "";
            $username = $_POST["pseudo"] ?? "";
            $email = $_POST["email"] ?? "";
            $pwd1 = $_POST["password"] ?? "";
            $pwd2 = $_POST["confirmpwd"] ?? "";

            if ($value == "" || $username == "" || $email == "" || $pwd1 == "" || $pwd2 == "")
                $errors[] = "Tous les champs sont obligatoires";

            if (hash_equals($app->getToken(), $token) === false)
                $errors[] = "Token incoherent";
            
            if ($pwd1 != $pwd2){
                $errors[] = "Les mots de passes doivent etre identiques";
            }

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
                $errors[] = "Format mail incorrect";
            

            if (count($errors) == 0)
            {
                $pass = password_hash($pwd1, PASSWORD_DEFAULT);
                $code = bin2hex(random_bytes(16));
                if ($model->add($username, $email, $pass, $code))
                {
                    $this->send_verification_mail($email, $code);
                    $args["success"] = "Un mail de confirmation vient de vous etre envoyé";
                }
                else {
                    $errors[] = "Le compte n'a pas pu etre cree";
                }
            }
        }
        $args = ["errors" => $errors];
        $args['token'] = $app->refreshToken();
        var_dump($args);
        $this->render("register", $args);
    }

    public function send_verification_mail($to, $code)
    {
        $subject = "Verification de votre inscription";
        $message = "
        <html>
        <head>
        <title>Mail de verification</title>
        </head>
        <body>
        <p>Merci de bien vouloir valider votre compte en cliquant sur le lien suivant : <a href='http://localhost:8100/camagru/index.php?p=user.verify&key=$code'>Je confirme mon compte</a></p>
        Ou bien en vous rendant sur l'url suivante : http://localhost:8100/camagru/index.php?p=user.verify&key=$code
        </body>
        </html>
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail($to,$subject,$message,$headers);
    }

    public function logout()
    {

    }
}