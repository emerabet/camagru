<?php

namespace App\Models;

class Model 
{
    protected $db;

    public function __construct(\App\Database $db) {
        $this->db = $db;
    }
}