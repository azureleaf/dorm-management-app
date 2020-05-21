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
use App\Room;
use App\RoleTitle;

// routes for view
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


// routes for axios
Route::get('/users', function () {
    // error_log(User::find(2)->room->room);
    // return User::all();

    $merged = collect([]);
    foreach (User::all() as $user) {
        $user->room;
        $merged->push($user);
    }
    return $merged;
});

Route::get('/billings', function () {
    return Billing::all();
});

Route::get('/rooms', function () {
    $merged = collect([]);
    foreach (Room::orderBy("room")->get() as $room) {
        // append "user" key with values
        // values will be the obj of related user if exists
        // values will be "null" for no user is related
        $room->user;

        $merged->push($room);
    }
    return $merged;
});


Route::get('/roletitles', function () {
    return RoleTitle::all();
});

Route::post('/edit/room/status/{room_id}', function (Request $req, $room_id) {
    $room = Room::find($room_id);
    $room->comment = $req->comment;
    $room->status = $req->status;
    $room->save();
});


// routes for auth
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
