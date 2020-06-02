<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Room;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the User models with relations to Room models
        return User::with("room")->orderBy("id")->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Save new user data without room info
        $newComer = new User;
        $newComer->name_family_kanji = $request->name["family"]["kanji"];
        $newComer->name_first_kanji = $request->name["first"]["kanji"];
        $newComer->name_family_kana = $request->name["family"]["kana"];
        $newComer->name_first_kana = $request->name["first"]["kana"];
        $newComer->email = $request->email;
        $newComer->password = Hash::make($request->password);
        $newComer->move_in_at = $request->move_in_at;
        $newComer->save();

        // Get the Room model of the room in which the new comer move
        $room = Room::find($request->room_id);
        $room->status = "occupied";

        // Reload the new comer saved above, and add room with relationship
        $newComerRetrieved = User::find($newComer->id);
        $newComerRetrieved->room()->save($room);
        $newComerRetrieved->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id, $operation)
    {
        $user = User::find($user_id);

    if ($operation == "names") {
        $user->name_family_kanji = $request->name["family"]["kanji"];
        $user->name_first_kanji = $request->name["first"]["kanji"];
        $user->name_family_kana = $request->name["family"]["kana"];
        $user->name_first_kana = $request->name["first"]["kana"];
        $user->email = $request->email;
        $user->comment = $request->comment;
        $user->save();
    } else if ($operation == "password") {
        $user->password = Hash::make($request->password);
        $user->save();
    } else if ($operation == "transfer") {
        $oldRoom = Room::find($request->old_room_id);
        $oldRoom->status = "vacant";
        $oldRoom->user_id = null; // Can this be updated with relationship?
        $oldRoom->save();

        $newRoom = Room::find($request->new_room_id);
        $newRoom->status = "occupied";
        $user->room()->save($newRoom);
    } else if ($operation == "leave") {
        $room = Room::where("user_id", $user_id)->first();
        $room->status = "vacant";
        $room->user_id = null;
        $room->save();

        $user->move_out_at = $request->move_out_at;
        $user->save();
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
