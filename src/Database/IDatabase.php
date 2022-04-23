<?

namespace App\Database;

interface IDatabase
{
    public function __construct();
    public function Query($sql, $data);
    public function Create($table, $data);
    public function Read($table, $data);
    public function Update();
    public function Delete();
}