<?
require_once __DIR__.'/vendor/autoload.php';
use App\Router;
use App\Controller\Root_controller;

use Steampixel\Route;
Route::add('/', function() {

});

Route::add('/login', function() {
   $userC=  new \App\Controllers\UserController();
   $userC->login();
}, 'post');

Route::add('/register', function() {
    $userC =  new \App\Controllers\UserController();
    $userC->register();
}, 'post');

Route::run('/api/');
