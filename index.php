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

Route::add('/user/([0-9]*)', function($id) {
    new \App\Controllers\UserController($id);
}, 'get');

Route::add('/user', function() {
    new \App\Controllers\UserController();

}, 'post');

Route::add('/user/update', function() {
    new \App\Controllers\UserController();

}, '');
Route::run('/api/');
