<?php


namespace App\Models;

use App\Database\Database;
use App\Database\PDODB;

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database(new PDODB());
    }

    public function Auth($login, $pass)
    {

        if(!empty($login) && !empty($pass))
        {
            $param = [
                "FIELDS" => [
                    "id",
                    "name",
                    "login",
                    "password"
                ],
                "PARAMS"=>[
                    "login" => $login
                ]
            ];
            $data = $this->db->Read('users', $param);


            return $data;
        }





    }

    public function PushData($data)
    {

        $data = $this->db->Create('users', $data);

        return $data;
    }
}