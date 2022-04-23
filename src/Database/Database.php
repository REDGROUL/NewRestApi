<?

namespace App\Database;

class Database
{
    private $db_object;

    public function __construct(IDatabase $db_object)
    {
        //$this->db_object = $db_object;

//        $db_object->Create('users', array(
//            'name'=>'fred',
//            'login'=>'fredbot',
//            'password'=>'1234'
//        ));

        $tmp = $db_object->Read('users', array(
            'FIELDS' =>
                [
                    "name",
                    "login"
                ],
            'PARAMS' =>
                [
                    'id' => 1,
                    'password'=>'1234'
                ]
        ));


    }


}