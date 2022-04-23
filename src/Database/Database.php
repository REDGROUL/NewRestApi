<?

namespace App\Database;

class Database
{
    private $db_object;

    public function __construct(IDatabase $db_object)
    {
        $this->db_object = $db_object;

        $db_object->Create('users', array(
            'name'=>'jhon',
            'login'=>'jhonthebest',
            'password'=>'1234'

        ));
    }

}