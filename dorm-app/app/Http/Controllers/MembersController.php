<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MembersController extends Controller
{
    // URLからパラメータを抜き出すテスト
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
                return "Requested member is " . $member->name . '. His room number is ' . $member->room;
            }
        }
    }

    // Show all the members
    public function showAll()
    {
        // Get the instance for User model
        // Returns null if the user isn't logged in
        $user = Auth::user();

        $data = [
            'members' => DB::table('members')
                ->get(),
            'user' => $user
        ];
        return view('MembersController.member', $data);
    }

    // Show the single member specified by the form input
    public function showFiltered(Request $request)
    {
        $user = Auth::user();

        if (
            $request->currMembers == "shown" and
            $request->pastMembers == "shown"
        ) {
            session()->put([
                'currMember' => 'shown',
                'pastMember' => 'shown'
            ]);
            return redirect()->action('MembersController@showAll');
        } elseif ($request->pastMembers == "shown") {
            $data = [
                'members' => DB::table('members')
                    ->where('is_living', '=', 0)
                    ->get(),
            ];
            session()->put([
                'currMember' => 'hidden',
                'pastMember' => 'shown'
            ]);
        } elseif ($request->currMembers == "shown") {
            $data = [
                'members' => DB::table('members')
                    ->where('is_living', '=', 1)
                    ->get(),
            ];
            session()->put([
                'currMember' => 'shown',
                'pastMember' => 'hidden'
            ]);
        } else {
            $data = [
                'members' => [],
            ];
            session()->put([
                'currMember' => 'hidden',
                'pastMember' => 'hidden'
            ]);
        }

        // 認証済みユーザ情報を付加
        $data['user'] = $user;

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
                'last_name' => $request->lastName,
                'first_name' => $request->firstName,
                'last_name_reading' => $request->lastNameReading,
                'first_name_reading' => $request->firstNameReading,
            ]);

        // 更新された表を表示
        return redirect()->action('MembersController@showAll');
    }
}
