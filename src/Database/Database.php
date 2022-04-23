<?

namespace App\Database;

class Database
{
    private $db_object;

    public function __construct(IDatabase $db_object)
    {
        $this->db_object = $db_object;
    }

    public function Create($table, $data)
    {
       return $this->db_object->Create($table, $data);
    }

    public function Read($table, $data)
    {
        $d = $this->db_object->Read($table, $data);
        return $d;
    }

    public function Query($sql, $data)
    {
        return $this->db_object->Query($sql, $data);
    }


}