<?

namespace App\Database;

interface IDatabase
{
    public function __construct();
    public function Query();
    public function Create($table, $data);
    public function Read();
    public function Update();
    public function Delete();
}