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
    public function showAll()
    {
        $data = [
            'members' => DB::table('members')
            ->get()
        ];
        return view('MembersController.member', $data);
    }

    // Show the single member specified by the form input
    public function showOne(Request $request)
    {
        if ($request->roomNum=='') {
            // 検索条件が空欄の場合には、全ての寮生を表示する
            return redirect()->action('MembersController@showAll');
        }
        $data = [
            'members' => DB::table('members')
            ->where('room', '=', $request->roomNum)
            ->get()
        ];
        return view('MembersController.member', $data);
    }


    // Show the single member specified by the form input
    public function add(Request $request)
    {

        // 部屋番号の重複を排除する処理、もしくは、既存の部屋番号なら内容を更新するという処理をここに書く予定
        
        // 無効な部屋番号や無効な名前（空欄とか）などを排除する処理をここに書く予定

        // 指定された寮生を追加する
        DB::table('members')
            ->insert([
                'room' => $request->room,
                'name' => $request->name,
                ]);

        // 更新された表を表示
        return redirect()->action('MembersController@showAll');
    }
}
