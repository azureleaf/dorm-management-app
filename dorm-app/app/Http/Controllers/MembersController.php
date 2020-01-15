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

    // Show all the payments
    public function showPayments()
    {
        $data = [
            'payments' => DB::table('payments')
            ->get()
        ];
        return view('MembersController.payment', $data);
    }

    // Show all the members
    public function showMembers()
    {
        $data = [
            'members' => DB::table('members')
            ->get()
        ];
        return view('MembersController.member', $data);
    }

    // Show the single member specified by the form input
    public function showSingleMember(Request $request)
    {
        $data = [
            'members' => DB::table('members')
            ->where('room', '=', $request->roomNum)
            ->get()
        ];
        return view('MembersController.member', $data);
    }
}
