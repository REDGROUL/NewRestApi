<?
require_once __DIR__.'/vendor/autoload.php';
use App\Router;
use App\Controller\Root_controller;

use Steampixel\Route;
Route::add('/', function() {

});

Route::add('/api/login', function() {
   $userC=  new \App\Controllers\UserController();
   $userC->login();
}, 'post');

Route::add('/login', function() {
   $userC=  new \App\Controllers\UserController();
   $userC->login();
}, 'get');

Route::add('/api/register', function() {
    $userC =  new \App\Controllers\UserController();
    $userC->register();
}, 'post');

Route::run('/');
