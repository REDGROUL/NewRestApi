<?

namespace App\Database;

use App\Config;
use App\Libs\Json_encoder;
use PDO;

class PDODB implements IDatabase
{

    private $db;
    private $query;

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

    public function Query($sql, $data = null)
    {

        if (!empty($sql))
        {

            $this->query = $this->db->prepare($sql); //Подготовка запроса

            if($data != null)
            {
                $this->QueryBind($data); //Бинд значений
            }
            $this->query->execute(); //Выполнение

            $result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            if(!empty($result))
            {

                return [
                    "STATUS"=>true,
                    "DATA"=>$result
                ];
            }
            else
            {
                return [
                    "STATUS"=>false,
                    "DATA"=>[
                        "SQL"=>"SQL syntax error"
                    ]
                ];
            }
        }
        else
        {
            return [
                "STATUS"=>false,
                "DATA"=> [
                    "SQL"=>"SQL is empty"
                ]
            ];
        }

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

            $query->execute($data);

            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }


    }

    public function Delete()
    {
        // TODO: Implement Delete() method.
    }

    public function Read($table, $data = null)
    {
        $select = '*';
        $NameField = '';
        $NameParams = '';
        $sql = "SELECT ".$select." FROM `".$table;
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


        if(!empty($data['PARAMS']))
        {
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

            $NameParams = "`WHERE`".$NameField;

            $sql = "SELECT ".$select." FROM `".$table.$NameParams;

        }

        $query = $this->db->prepare($sql);



        $query->execute($data['PARAMS']);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    private function QueryBind($params)
    {
        if (!empty($params)) {

            foreach ($params as $key=>$param)
            {
               $bind = $this->query->bindValue(":".$key, $param, PDO::PARAM_STR);

            }
        }
    }

    public function Update()
    {
        // TODO: Implement Update() method.
    }
}