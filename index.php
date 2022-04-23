<?

use App\Database\Database;

require_once __DIR__.'/vendor/autoload.php';


$db = new Database(new \App\Database\PDODB());
