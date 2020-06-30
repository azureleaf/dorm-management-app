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

use App\PersonalAccountTitle;

/**
 * Vue Router
 */
Route::get('/', function () {
    return view('show');
});

/**
 * Views
 */
Route::get('/intro', function () {
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


/**
 * Controllers
 */

// Billing
Route::get('/billings', 'BillingController@index');
Route::get('/billings/unpaid', 'BillingController@unpaid'); // original
Route::get('/billings/unpaid/ranking', 'BillingController@ranking'); // original
Route::put('/billings/update/paid', 'BillingController@paid'); // original

//Billing Details
Route::get('/billing-details', 'BillingDetailController@index');
Route::post('/billing-details', 'BillingDetailController@store'); // alters billings table as well

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
Route::post('/role-histories', 'RoleHistoryController@store');
Route::put('/role-histories/{hx_id}', 'RoleHistoryController@update');
Route::delete('/role-histories/{hx_id}', 'RoleHistoryController@destroy');

// Personal Accounting
Route::get('/personal/titles', function () {
    return PersonalAccountTitle::orderBy("id")->get();
});

// Monthly Fees
Route::get('monthly-fees', 'MonthlyFeeController@index');
Route::post('monthly-fees', 'MonthlyFeeController@store');

/**
 * Auth
 */
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
