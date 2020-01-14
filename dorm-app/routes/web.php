<?php

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

Route::get('/', function () {
    return view('welcome');
});

// メンバーを表示する
// IDが特定されたなら、そのメンバのみを表示
// IDが特定されていないなら、全てのメンバを表示する
// IDが見つからない場合には、その旨を表示
Route::get('/members/{id?}', 'MembersController@index');
