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
     *
     * @param $sql - sql запроос
     * @param $data - ассоциативный массив с данными
     *
     */

    public function Query($sql, $data = null)
    {

        if (!empty($sql)) {

            $this->query = $this->db->prepare($sql); //Подготовка запроса


            if ($data != null) {
                $this->QueryBind($data); //Бинд значений
            }

            $this->query->execute(); //Выполнение

            $result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            if ( $this->CheckQuerySyntax()['STATUS']!= true) {
                $resultCheck = $this->CheckQuerySyntax();
                return $resultCheck;
            }
            else
            {
                $answer = $this->GenerateAnswer($result);
                return $answer;
            }



        } else {
            return [
                "STATUS" => false,
                "DATA" => [
                    "SQL" => "SQL is empty"
                ]
            ];
        }

    }


    public function Create($table, $data = [])
    {
        if (!empty($data) && !empty($table)) {
            $FieldNames = '';
            $Placeholder = '';
            foreach ($data as $key => $item) {

                if (end($data) === $item) {
                    $FieldNames .= '`' . $key . '`';
                    $Placeholder .= ':' . $key;

                } else {
                    $FieldNames .= '`' . $key . '`,';
                    $Placeholder .= ':' . $key . ',';
                }
            }

            $FieldString = '(' . $FieldNames . ')';
            $PlaceholderString = '(' . $Placeholder . ')';


            $sql = "INSERT INTO `$table` " . $FieldString . ' VALUES ' . $PlaceholderString;

            $this->query = $this->db->prepare($sql);
            $this->QueryBind($data);
            $dbe = $this->query->execute();
            $result = $this->query->fetchAll(PDO::FETCH_ASSOC);


            $check = $this->CheckQuerySyntax();
            if($check['STATUS'] == true)
            {
                return [
                    "STATUS"=>true,
                    "DATA"=>[
                        "SQL"=>"add"
                    ],
                    "HTTP_CODE"=>201
                ];
            }
            else
            {
                return $check;
            }

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
        $sql = "SELECT " . $select . " FROM `" . $table;
        if (!empty($data['FIELDS'])) {
            $select = '';
            foreach ($data['FIELDS'] as $field) {
                if (end($data['FIELDS']) === $field) {
                    $select .= '`' . $field . '`';
                } else {
                    $select .= '`' . $field . '`,';
                }

            }

        }


        if (!empty($data['PARAMS'])) {
            foreach ($data['PARAMS'] as $key => $item) {

                if (end($data['PARAMS']) === $item) {
                    $NameField .= ' `' . $key . '` = :' . $key;
                } else {
                    $NameField .= ' `' . $key . '` = :' . $key . ' AND ';
                }
            }

            $NameParams = "`WHERE`" . $NameField;

            $sql = "SELECT " . $select . " FROM `" . $table . $NameParams;

        }

        $query = $this->db->prepare($sql);


        $query->execute($data['PARAMS']);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @param $params - ассоциативный массив
     *
     */
    private function QueryBind($params)
    {
        if (!empty($params)) {

            foreach ($params as $key => $param) {
                $bind = $this->query->bindValue(":" . $key, $param, PDO::PARAM_STR);

            }
        }
    }

    /**
     * Проверяет синтаксис запроса
     * @return array|bool
     */

    private function CheckQuerySyntax()
    {
        //var_dump($this->query->errorInfo());
        if (!empty($this->query->errorInfo()[2])) {
            return [
                "STATUS" => false,
                "DATA" => [
                    "SQL" => $this->query->errorInfo()[2]
                ],
                "HTTP_CODE" => 400
            ];

        } else {

          return [
              "STATUS"=>true
          ];
        }
    }


    /**
     *
     * @param $result - ассоциативный массив с данными из бд
     * @return array
     *
     */

    private function GenerateAnswer($result)
    {
        if (!empty($result)) {

            return [
                "STATUS" => true,
                "DATA" => $result
            ];
        } else {
            return [
                "STATUS" => false,
                "DATA" => [
                    "SQL" => "Not found"
                ]
            ];
        }
    }


    public function Update()
    {
        // TODO: Implement Update() method.
    }
}