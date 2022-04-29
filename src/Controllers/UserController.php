<?php


namespace App\Controllers;
use App\Database\Database;
use App\Libs\Json_encoder;
use App\Libs\JWTHelper;
use App\Models\UserModel;

class UserController
{

    private $id;
    private $httpCode;
    private $method;
    public function __construct($id = null)
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this-> id = $id;
    }

    public function JsonExp($status, $data)
    {
        Json_encoder::JsonOut($status, $data);
    }

    public function register()
    {
        $name = $_POST['name'];
        $login = $_POST['login'];
        $pass = $_POST['password'];


        if(!empty($name) && !empty($login) && !empty($pass))
        {
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $userModel = new UserModel();
            $push = $userModel->PushData(array(
                "name"=>$name,
                "login"=>$login,
                "password"=>$pass
            ));

            Json_encoder::JsonOut($push['STATUS'], $push['DATA'], '',$push['HTTP_CODE']);
        }
        else
        {
           Json_encoder::JsonOut(false, "FIELD", "Some filed is empty");
        }
    }

    public function login()
    {
        if($this->method == "GET")
        {
            require_once 'src/Views/Login.php';
        }

        $userModel = new UserModel();
        $login = $_POST['login'];
        $pass = $_POST['password'];
        $UMResult = $userModel->Auth($login, $pass);
        $passHash = $UMResult['DATA'][0]['password'];

        if (password_verify($pass, $passHash)) {
            $jwt = new JWTHelper();
            $jwt->GenerateTokens($UMResult['DATA'][0]['login']);
        }

    }

}