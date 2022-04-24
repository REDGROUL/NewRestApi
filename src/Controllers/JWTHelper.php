<?php


namespace App\Controllers;
use App\Database\Database;
use App\Libs\Json_encoder;
use App\Models\UserModel;

class UserController
{
    public function __construct($id = null)
    {
        $userModel = new UserModel();
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == "POST")
        {
            $name = $_POST['name'];
            $login = $_POST['login'];
            $pass = $_POST['password'];

            if(!empty($name) && !empty($login) && !empty($pass))
            {
                $push = $userModel->PushData(array(
                    "name"=>$name,
                    "login"=>$login,
                    "password"=>$pass
                ));

                $dbpush = $userModel->PushData($push);
            }
            else
            {
                echo 'cant get you data';
            }

        }
        else
        {
            $result = $userModel->GetData($id);
            $this->JsonExp(true, $result);
        }


    }

    public function JsonExp($status, $data)
    {
        Json_encoder::JsonOut($status, $data);
    }

}