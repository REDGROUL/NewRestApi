<?

namespace App\Database;

use App\Config;
use PDO;

class PDODB implements IDatabase
{

    private $db;

    public function __construct()
    {
        $DBinfo = Config::GetDBinfo();
        $this->db = new PDO('mysql:host=' . $DBinfo["DB_HOST"] . ';dbname=' . $DBinfo['DB_NAME'], $DBinfo['DB_USER'], $DBinfo['DB_PASS']);

    }

    public function Query()
    {
        // TODO: Implement Query() method.
    }

    public function Create($table, $data = [])
    {

        foreach ($data as $key=>$item)
        {

            if(end($data) === $item)
            {
                $FieldNames .= '`'.$key.'`';
                $Placeholder .= ':'.$key;

             }
            else
            {
                $FieldNames .= '`'.$key.'`,';
                $Placeholder .= ':'.$key.',';
            }


        }

        $FieldString = '('.$FieldNames.')';
        $PlaceholderString = '('.$Placeholder.')';


        $sql = "INSERT INTO `$table` ".$FieldString.' VALUES '.$PlaceholderString;
        $query = $this->db->prepare($sql);
        if ( !empty($data) ) {
            foreach ($data as $key => $value) {
                $query->bindValue(":$key", $value);
            }
        }

        $query->execute();

    }

    public function Delete()
    {
        // TODO: Implement Delete() method.
    }

    public function Read()
    {
        // TODO: Implement Read() method.
    }

    public function Update()
    {
        // TODO: Implement Update() method.
    }
}