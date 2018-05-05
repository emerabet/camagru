<?php

namespace App\Models;

class Auth extends Model
{
    public function __construct(\App\Database $database)
    {
        parent::__construct($database);
    }

    public function login($login, $pwd)
    {
        return false;
    }
}