<?php 

namespace App\Controllers;

class PhotoController extends Controller
{
    public function index()
    {
        $this->render("webcam");
    }

    public function save()
    {
        $res = false;
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            http_response_code(404);
        
        if (isset($_POST['data']))
           //$test = stripslashes($_POST['data']);

            var_dump($_POST['data']);
           $ppp = json_decode($_POST['data']);
           var_dump($ppp->itms[0]->top);
        
        http_response_code(200);                
    }
}