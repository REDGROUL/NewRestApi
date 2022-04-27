<?php


namespace App\Controllers;
use App\Database\Database;
use App\Libs\Json_encoder;
use App\Models\UserModel;

class UserController
{

    private $id;
    private $httpCode;
    public function __construct($id = null)
    {
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
        $userModel = new UserModel();
        $db = $userModel->GetData(1);
        if($db['HTTP_CODE'])
        {
            $this->httpCode = $db['HTTP_CODE'];
        }
        Json_encoder::JsonOut($db['STATUS'], $db['DATA'], '', $this->httpCode);
    }

}