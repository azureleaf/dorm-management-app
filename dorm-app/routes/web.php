<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', function () {
    return User::all();
});


Route::get('/test', function () {
    $users = DB::table('users')->get();
    foreach ($users as $user) {
        var_dump($user);
        return;
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
