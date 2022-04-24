<?
require_once __DIR__.'/vendor/autoload.php';
use App\Router;
use App\Controller\Root_controller;

use Steampixel\Route;
Route::add('/', function() {
    echo 'hi';
});

Route::add('/login', function() {
    new \App\Controllers\LoginController();
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
