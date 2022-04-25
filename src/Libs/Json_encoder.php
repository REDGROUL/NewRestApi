<?

namespace App\Libs;


class Json_encoder
{
    /**
     * @param $status - Статус вывода
     * @param $name_key - ассоциативный массив, или строка с названиями
     * @param null $value - Обязателен если в name_key передается строка
     * @param null $httpCode - Необязательный параметр, статус по умолчанию 200
     */

    public static function JsonOut($status, $name_key, $value = null, $httpCode = null)
    {
        header("Content-type: application/json; charset: utf-8");
        if($httpCode != null)
        {
            http_response_code($httpCode);
        }

        if (is_array($name_key) == true)
        {

            echo json_encode([
                "status" => $status,
                "payload" => $name_key
            ]);
        }
        else
        {
            echo json_encode([
                "status" => $status,
                "error" => array_combine(explode(',', str_replace(' ', '', $name_key)), explode(',', $value))
            ]);
        }


    }
}

