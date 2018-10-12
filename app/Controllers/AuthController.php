<?php 

namespace App\Controllers;

class AuthController extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function index($args = [])
    {
        $verif = $_GET['verif'] ?? "";
        if ($verif == "OK" || $verif == "KO")
            $args['verif'] = $verif;
        $app = \App\App::getInstance();
        $args['token'] = $app->refreshToken();
        $this->render('login', $args);
    }

    public function auth() 
    {
        $app = \App\App::getInstance();
        $args = [];
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $username = $_POST['pseudo'] ?? "";
            $pwd = $_POST['password'] ?? "";
            $token = $_POST['token'] ?? "";

            if ($username == "" || $pwd == "")
                $errors[] = "Champs vides";
            if (hash_equals($app->getToken(), $token) === false)
                $errors[] = "Token incoherent";

            if (count($errors) === 0)
            {
                $db = $app->getDb();
                $model = new \App\Models\Auth($db);
                $res = $model->login($username);
                $errors[] = "Le nom d'utilisateur ou le mot de passe est invalide.";
                if ($res !== false)
                {
                    if (password_verify($pwd, $res['password'])) 
                    {
                        unset($res['password']);
                        $_SESSION['user_logged'] = $res;

                        $cookie_name = "user_logged";
                        $last = $res;
                        unset($last['verified']);
                        setcookie($cookie_name, json_encode($last), time() + 3600, "/");
                        $this->redirect('home');
                    }
                }
            }
            $args = ["errors" => $errors];
        }
        $this->index($args);
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

            if ($this->check_password_strength($pwd1) === false)
                $errors[] = "Pattern du mot de passe incorrect";

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
                $errors[] = "Format mail incorrect";
            
            if (count($errors) == 0)
            {
                $pass = password_hash($pwd1, PASSWORD_DEFAULT);
                $code = bin2hex(random_bytes(16));
                if ($model->add($username, $email, $pass, $code, 0)) {
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
        mail($to, $subject, $message, $headers);
    }

    public function send_reset_mail($to, $code)
    {
        $subject = "Reinitialisation de votre mot de passe";
        $message = "
        <html>
        <head>
        <title>Reinitialisation de votre mot de passe</title>
        </head>
        <body>
        <p>Cliquer sur le lien pour : <a href='http://localhost:8100/camagru/index.php?p=user.forgot&key=$code'>Changer de password</a></p>
        Ou bien en vous rendant sur l'url suivante : http://localhost:8100/camagru/index.php?p=user.forgot&key=$code
        </body>
        </html>
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail($to, $subject, $message, $headers);
    }

    public function logout()
    {
        unset($_SESSION['user_logged']);
        setcookie("user_logged", "", time() - 8600, "/");
        $this->redirect('home');
    }

    public function forgot()
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
            $username = $_POST['pseudo'] ?? "";
            $email = $_POST['email'] ?? "";

            if ($value == "" || $token == "" || $username == "")
                $errors[] = "Champs incorrect";
            
            if (hash_equals($app->getToken(), $token) === false)
                $errors[] = "Token incoherent";
            
            $res = $model->find_by_email_username($email, $username);
            if (count($errors) === 0 && $res !== false)
            {
                $args["msg"] = "Mail de reset envoyé";
                $this->send_reset_mail($email, $res['verified']);
            }
            else
                $errors[] = "Champs incorrect";
            $args = ["errors" => $errors];
            $this->index($args);
        }
    }

    public function reset()
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
            $key = $_POST['key'] ?? "";
            $password1 = $_POST['password'] ?? "";
            $password2= $_POST['confirmpwd'] ?? "";            

            if ($value == "" || $token == "" || $key == "")
                $errors[] = "Champs incorrect";

            if ($password1 != $password2)
                $errors[] = "Password differents";
            
            if ($this->check_password_strength($password1) === false)
                $errors[] = "Pattern du mot de passe incorrect";

            if (count($errors) === 0)
            {
                $pass = password_hash($password1, PASSWORD_DEFAULT);
                $newkey = bin2hex(random_bytes(16));
                $res = $model->reset_password($key, $pass, $newkey);
                if ($res > 0) {
                    $_SESSION['reset'] = "Mot de passe réinitialisé";
                    $this->redirect('login', $args);
                }
            }
        }
        $args = ["errors" => $errors];
        $args['token'] = $app->refreshToken();
        $this->render('reset', $args);
    }
}