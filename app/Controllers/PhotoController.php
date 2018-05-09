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
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            exit;
        
        
    }
}