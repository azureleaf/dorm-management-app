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

use Illuminate\Http\Request;
use App\User;
use App\Billing;
use App\RoleTitle;
use App\RoleHistory;
use App\PersonalAccountTitle;

/**
 * Views
 */
Route::get('/', function () {
    return view('welcome');
});


Route::get('/userlist', function () {
    return view('user-list');
});


Route::get('/personalbook', function () {
    return view('personal-book');
});

Route::get('/dormbook', function () {
    return view('dorm-book');
});

Route::get('/application', function () {
    return view('application');
});


Route::get('/archive', function () {
    return view('archive');
});


/**
 * Billing
 */

Route::get('/billings', function () {
    return Billing::all();
});


// Rooms
Route::get('/rooms', 'RoomController@index');
Route::get('/rooms/available', 'RoomController@available'); // original
Route::put('/rooms/{room_id}/', 'RoomController@update');

// User
Route::get('/users', 'UserController@index');
Route::post('/users', 'UserController@store');
Route::put('/users/{user_id}/operation/{operation}', 'UserController@update');

// Role Titles
Route::get('/role-titles', function () {
    return RoleTitle::all();
});

// Role Histories
Route::get('/role-histories', 'RoleHistoryController@index');
Route::post('/role-histories/', 'RoleHistoryController@store');
Route::put('/role-histories/{hx_id}', 'RoleHistoryController@update');
Route::delete('/role-histories/{hx_id}', 'RoleHistoryController@destroy');

/**
 * Personal accounting
 */

Route::get('/personal/titles', function () {
    return PersonalAccountTitle::orderBy("id")->get();
});


/**
 * Auth
 */
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
