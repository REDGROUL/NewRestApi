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

    /**
     * @method Query - выполняет кастомный запрос
     * @param $sql - sql запроос
     * @param $data - ассоциативный массив с данными
     *
     */

    public function Query($sql, $data)
    {
        $query = $this->db->prepare($sql);
        if ( !empty($data) )
        {
            foreach ($data as $key => $value)
            {
                $query->bindValue(":$key", $value);
            }
        }
        else
        {
            //write something
        }
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function Create($table, $data = [])
    {
        if ( !empty($data) && !empty($table))
        {
            $FieldNames= '';
            $Placeholder= '';

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

//            foreach ($data as $key => $value)
//            {
//                $query->bindValue(":$key", $value);
//            }

            $query->execute($data);


        }


    }

    public function Delete()
    {
        // TODO: Implement Delete() method.
    }

    public function Read($table, $data)
    {
        $select = '*';

        if(!empty($data['FIELDS']))
        {
            $select = '';
            foreach ($data['FIELDS'] as $field)
            {
                if(end($data['FIELDS']) === $field)
                {
                    $select .='`'.$field.'`';
                }
                else
                {
                    $select .='`'.$field.'`,';
                }

            }

        }

        $NameField = '';
        foreach ($data['PARAMS'] as $key=>$item)
        {

            if(end($data['PARAMS']) === $item)
            {
                $NameField .= ' `'.$key.'` = :'.$key;
            }
            else
            {
                $NameField .= ' `'.$key.'` = :'.$key.' AND ';
            }
        }

        $sql = "SELECT ".$select." FROM `".$table."` WHERE ".$NameField;
        $query = $this->db->prepare($sql);

//        foreach ($data['PARAMS'] as $key => $value)
//        {
//            $query->bindValue(":$key", $value);
//        }


        $query->execute($data['PARAMS']);

        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function Update()
    {
        // TODO: Implement Update() method.
    }
}