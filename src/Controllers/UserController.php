<?php


namespace App\Controllers;
use App\Database\Database;
use App\Libs\Json_encoder;
use App\Models\UserModel;

class UserController
{

    private $id;
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
            $userModel = new UserModel();
            $push = $userModel->PushData(array(
                "name"=>$name,
                "login"=>$login,
                "password"=>$pass
            ));

            $dbpush = $userModel->PushData($push);
        }
        else
        {
           Json_encoder::JsonOut(false, "error", "Some filed is empty");
        }
    }

    public function login()
    {

    }

}