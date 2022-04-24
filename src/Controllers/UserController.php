<?php


namespace App\Controllers;
use App\Database\Database;
use App\Libs\Json_encoder;
use App\Models\UserModel;

class UserController
{
    public function __construct($id)
    {

            $userModel = new UserModel();
            $result = $userModel->GetData($id);
            $this->JsonExp(true, $result);
    }

    public function JsonExp($status, $data)
    {
        Json_encoder::JsonOut($status, $data);
    }

}