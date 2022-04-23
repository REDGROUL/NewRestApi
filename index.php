<?
require_once __DIR__.'/vendor/autoload.php';
use App\Router;
use App\Controller\Root_controller;
$r = new Router();

$r->get('/', function (){

});


$r->start();
