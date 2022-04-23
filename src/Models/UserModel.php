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
        $param = array(
            "FIELDS"=>[
                "name",
                "login",
                "photo",
                "status",
                "online",
                "last_activity"
            ],
            "PARAMS"=>[
                "id"=>$id
            ]
        );
        $data = $this->db->Read('users', $param);

        return $data;
    }
}