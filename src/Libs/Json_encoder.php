<?

namespace App\Libs;


class Json_encoder
{
    public static function JsonOut($status, $name_key, $value = null)
    {
        if (is_array($name_key) == true)
        {
            header("Content-type: application/json; charset: utf-8");
            echo json_encode([
                "status" => $status,
                "payload" => $name_key
            ]);
        }
        else
        {
            header("Content-type: application/json; charset: utf-8");
            echo json_encode([
                "status" => $status,
                "error" => array_combine(explode(',', str_replace(' ', '', $name_key)), explode(',', $value))
            ]);
        }


    }
}

