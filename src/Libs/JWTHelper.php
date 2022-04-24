<?php


namespace App\Controllers;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTHelper
{
    public function __construct()
    {
        $key = '7981A54D6D58A2F9ABA77A4C6D12B39A60931E179B919D049AC29FE38A124F70'; //=>ThisIsMySuperPrivateKey
        $payload = [
            'iss' => 'localhost',
            'aud' => 'localhost',
            'iat' => 1356999524,
            'nbf' => 1357000000
        ];

        $jwt = JWT::encode($payload, $key, 'HS256');
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

        print_r($jwt);
    }
}