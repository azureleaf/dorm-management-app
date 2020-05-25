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
use App\PersonalAccountTitle;

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
    // Get all the User models with relations to Room models
    return User::with("room")->get();
});

Route::get('/billings', function () {
    return Billing::all();
});

Route::get('/rooms', function () {
    return Room::with("user")->orderBy("number")->get();

    /** Unused code below do the same as above but verbose */
    $merged = collect([]);
    foreach (Room::orderBy("number")->get() as $room) {
        // append "user" key with values
        // values will be the obj of related user if exists
        // values will be "null" when no user is related
        $room->user;
        $merged->push($room);
    }
    return $merged;
});


Route::get('/rooms/available', function () {
    // return Room::where('status', 'vacant')->pluck("room")->toArray();
    return Room::where('status', 'vacant')->get();
});

Route::post('/create/user', function (Request $req) {
    // Save new user data without room info
    $newComer = new User;
    $newComer->name_family_kanji = $req->name["family"]["kanji"];
    $newComer->name_first_kanji = $req->name["first"]["kanji"];
    $newComer->name_family_kana = $req->name["family"]["kana"];
    $newComer->name_first_kana = $req->name["first"]["kana"];
    $newComer->email = $req->email;
    $newComer->password = Hash::make($req->password);
    $newComer->move_in_at = $req->move_in_at;
    $newComer->save();

    // Get the Room model of the room in which the new comer move
    $room = Room::find($req->room_id);
    $room->status = "occupied";

    // Reload the new comer saved above, and add room with relationship
    $newComerRetrieved = User::find($newComer->id);
    $newComerRetrieved->room()->save($room);
    $newComerRetrieved->save();
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

Route::get('/personal/titles', function () {
    return PersonalAccountTitle::orderBy("id")->get();
});


// routes for auth
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
