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

use App\Billing;
use App\PersonalAccountTitle;

/**
 * Views
 */
Route::get('/', function () {
    return view('introduction');
});

Route::get('/user-list', function () {
    return view('user_list');
});

Route::get('/personal-accounting', function () {
    return view('personal_accounting');
});

Route::get('/dorm-accounting', function () {
    return view('dorm_accounting');
});

// Route::get('/schedule', function () {
//     return view('schedule');
// });

// Route::get('/document', function () {
//     return view('document');
// });


/**
 * Billing
 */
Route::get('/billings', 'BillingController@index');

/**
 * Billing Details
 */
Route::get('/billing-details', 'BillingDetailController@index');

// Rooms
Route::get('/rooms', 'RoomController@index');
Route::get('/rooms/available', 'RoomController@available'); // original
Route::put('/rooms/{room_id}/', 'RoomController@update');

// Users
Route::get('/users', 'UserController@index');
Route::get('/users/monthly/{year}/{month}', 'UserController@monthly'); // original
Route::post('/users', 'UserController@store');
Route::put('/users/{user_id}/operation/{operation}', 'UserController@update');

// Role Titles
Route::get('/role-titles', 'RoleTitleController@index');
Route::put('/role-titles/{role_title_id}', 'RoleTitleController@update');

// Role Histories
Route::get('/role-histories', 'RoleHistoryController@index');
Route::post('/role-histories/incumbents', 'RoleHistoryController@incumbents'); // original
Route::post('/role-histories/', 'RoleHistoryController@store');
Route::put('/role-histories/{hx_id}', 'RoleHistoryController@update');
Route::delete('/role-histories/{hx_id}', 'RoleHistoryController@destroy');

/**
 * Personal accounting
 */

Route::get('/personal/titles', function () {
    return PersonalAccountTitle::orderBy("id")->get();
});

// Monthly Fees
Route::get('monthly-fees', 'MonthlyFeeController@index');
Route::put('monthly-fees/{fee_id}', 'MonthlyFeeController@update');

/**
 * Auth
 */
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
