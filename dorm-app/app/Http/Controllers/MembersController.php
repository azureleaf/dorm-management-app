<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MembersController extends Controller
{
    public function index($id = 'noid')
    {
        if ($id == 'noid') {
            return "No ID specified";
        } else {
            $member = DB::table('members')
            ->where('id', '=', $id)
            ->first();
            if (!$member) {
                // 該当するIDのメンバが見つからなかった場合の処理
                return "Member for the specified ID isn't found";
            } else {
                return "Requested member is ".$member->name.'. His room number is '.$member->room;
            }
        }
    }

    public function blade(){
        return view();
    }
}
