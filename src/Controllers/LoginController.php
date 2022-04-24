<?php


namespace App\Controllers;
use App\Libs\JWTHelper;

class LoginController
{
    public function __construct()
    {
        $jwt = new JWTHelper();
        $jwt->GenerateTokens();
    }
}