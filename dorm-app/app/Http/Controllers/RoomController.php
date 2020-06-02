<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class RoomController extends Controller
{
    public function index() {
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
    }

    public function available() {
        // return Room::where('status', 'vacant')->pluck("room")->toArray();
        return Room::where('status', 'vacant')->orderBy("number")->get();
    }

    public function update(Request $req, $room_id) {
        $room = Room::find($room_id);
        $room->comment = $req->comment;
        $room->status = $req->status;
        $room->save();
    }
}
