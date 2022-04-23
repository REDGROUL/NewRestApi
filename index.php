<?
require_once __DIR__.'/vendor/autoload.php';
use App\Router;
use App\Controller\Root_controller;
use Steampixel\Route;
Route::add('/', function() {
    echo 'hi';
});

Route::add('/user/([0-9]*)', function($id) {
    new \App\Controllers\UserController($id);
}, 'get');
Route::run('/api/');
