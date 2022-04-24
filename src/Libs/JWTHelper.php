<?php


namespace App\Libs;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Config;

class JWTHelper
{
    private $key;
    private $host;
    private $payload;


    public function __construct()
    {

        $this->key = Config::SERVER_KEY;
        $this->host = $_SERVER['HTTP_HOST'];

    }

    public function GenerateTokens()
    {
        $time = time();

        $JwtAccess = [
            'iss' => $this->host,
            'aud' => $this->host,
            'iat' => $time,
            'exp' => $time + 900,

        ];

        $JwtRefresh = [
            'iss' => $this->host,
            'aud' => $this->host,
            'iat' => $time + 900,
            'exp' => $time + 2592000
        ];


        $this->payload = [
            "Acess"=>JWT::encode($JwtAccess, $this->key, 'HS256'),
            "Refresh"=>JWT::encode($JwtRefresh, $this->key, 'HS256')
        ];

        $this->ToJson($this->payload);
    }


    private function ToJson($payload)
    {
        Json_encoder::JsonOut(true, $payload);
    }

    public function CheckToken()
    {

    }


}