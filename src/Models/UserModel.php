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

    public function GetData($id)
    {
//        $param = array(
//            "FIELDS"=>[
//                "name",
//                "login",
//                "photo",
//                "status",
//                "online",
//                "last_activity"
//            ],
//            "PARAMS"=>[
//                "id"=>$id
//            ]
//        );

        $param = [
            "id"=>$id
        ];
        //$data = $this->db->Read('users', $param);
        $data = $this->db->Query("SELECT * FROM `users` WHERE id = :id", $param);

        var_dump($data);
        return $data;
    }

    public function PushData($data)
    {

        $data = $this->db->Create('users', $data);

        return $data;
    }
}