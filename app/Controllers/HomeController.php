<?php

namespace App\Controllers;

class HomeController extends Controller 
{
    public function __construct() {
        parent::__construct();
    }

    public function home() 
    {
        $this->render('home');
    }

    public function load()
    {
        $app = \App\App::getInstance();
        $args = [];
        $errors = [];
    }
}