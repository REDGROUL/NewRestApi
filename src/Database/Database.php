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

    /**
     * @param $table - Таблица
     * @param $data - Ассоциативный массив данных
     * @return mixed
     */
    public function Create($table, $data)
    {
        $result = $this->db_object->Create($table, $data);
        return $result;
    }

    /**
     * @param $table - Таблица
     * @param $data - Ассиацтинвый двуменый массив FILES - поля для вывода PARAMS - Условия выборки
     * @return mixed
     */

    public function Read($table, $data = null)
    {
        $result = $this->db_object->Read($table, $data);
        return $result;
    }

    public function Query($sql, $data = null)
    {
        return $this->db_object->Query($sql, $data);
    }


}