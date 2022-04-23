<?php


namespace App\Controllers;
use App\Database\Database;
use App\Libs\Json_encoder;
use App\Models\UserModel;

class UserController
{
    public function __construct($id)
    {

        if ($id != null)
        {
            $userModel = new UserModel();
            $result = $userModel->GetData($id);

            $this->JsonExp($result);
        }
    }

    public function JsonExp($data)
    {
        Json_encoder::JsonOut(true, $data);
    }

}