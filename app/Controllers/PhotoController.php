<?php 

namespace App\Controllers;

class PhotoController extends Controller
{
    public function index()
    {
        $this->render("webcam");
    }
}