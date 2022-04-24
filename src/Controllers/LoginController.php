<?php


namespace App\Controllers;
use App\Libs\JWTHelper;

class LoginController
{
    public function __construct()
    {
        $jwt = new JWTHelper();
       // $jwt->GenerateTokens();
        $jwt->CheckToken("eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJuZXdyZXN0YXBpIiwiYXVkIjoibmV3cmVzdGFwaSIsImlhdCI6MTY1MDgyODgyNywiZXhwIjoxNjUwODI5NzI3fQ.0_3cHRcDS1Pu9MY3QlmX_0SXW0BinUj4tbKY-6mREdc");
    }
}