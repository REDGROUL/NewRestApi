<?

namespace App\Database;

use mysql_xdevapi\Result;

class Database
{
    private $db_object;

    public function __construct(IDatabase $db_object)
    {
        $this->db_object = $db_object;
    }

    public function Create($table, $data)
    {
        $result = $this->db_object->Create($table, $data);
        return $result;
    }

    public function Read($table, $data)
    {
        $result = $this->db_object->Read($table, $data);
        return $result;
    }

    public function Query($sql, $data)
    {
        return $this->db_object->Query($sql, $data);
    }


}