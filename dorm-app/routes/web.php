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
use App\Billing;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/userlist', function () {
    return view('user-list');
});


Route::get('/personalbook', function () {
    return view('personal-book');
});

Route::get('/users', function () {
    return User::all();
});

Route::get('/billings', function () {
    return Billing::all();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
