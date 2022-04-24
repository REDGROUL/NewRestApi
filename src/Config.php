<?

namespace App;

class Config
{
    const DB_NAME = 'newrest';
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = '';
    const SERVER_KEY = '7981A54D6D58A2F9ABA77A4C6D12B39A60931E179B919D049AC29FE38A124F70'; //=>ThisIsMySuperPrivateKey

    public static function GetDBinfo()
    {
        return array(
            'DB_HOST' => self::DB_HOST,
            'DB_NAME' => self::DB_NAME,
            'DB_USER' => self::DB_USER,
            'DB_PASS' => self::DB_PASS,
        );
    }

    public static function GetServerKey()
    {
        return self::SERVER_KEY;
    }
}