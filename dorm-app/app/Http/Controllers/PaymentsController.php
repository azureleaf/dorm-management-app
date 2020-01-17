<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    // Show all the payments
    public function showAll()
    {
        $data = [
            'payments' => DB::table('payments')
            ->get()
        ];
        return view('PaymentsController.payment', $data);
    }

    // Show all the payments
    public function showFiltered(Request $request)
    {
        if ($request->member_id=='') {
            // 検索条件が空欄の場合には、全ての支払い記録を表示する
            return redirect()->action('PaymentsController@showAll');
        }
        $data = [
            'payments' => DB::table('payments')
            ->where('member_id', '=', $request->member_id)
            ->get()
        ];
        return view('PaymentsController.payment', $data);
    }


    // Add

    public function register(Request $request)
    {

        // 残高を計算する機能をここにつける
        // $balance = DB:table::() + $request->amount

        // 指定された履歴を追加する
        DB::table('payments')
            ->insert([
                'description' => $request->description,
                'member_id' => $request->member_id,
                'amount' => $request->amount,
                'balance' => 99999,
                ]);

        // 更新された表を表示
        return redirect()->action('PaymentsController@showAll');
    }
}
