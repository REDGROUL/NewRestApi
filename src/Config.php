<?

namespace App;

class Config
{
    const DB_NAME = 'newrest';
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = '';

    public static function GetDBinfo()
    {
        return array(
            'DB_HOST'=>self::DB_HOST,
            'DB_NAME'=>self::DB_NAME,
            'DB_USER'=>self::DB_USER,
            'DB_PASS'=>self::DB_PASS,
        );
    }
}