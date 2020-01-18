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
            ->get(),
            'roomStatuses' => $this->getRoomStatuses(),
            'paymentCategories' => $this->getPaymentCategories()
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
            ->get(),
            'roomStatuses' => $this->getRoomStatuses(),
            'paymentCategories' => $this->getPaymentCategories()
        ];
        return view('PaymentsController.payment', $data);
    }


    // Add new payment record(s)
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

    // 部屋が空室なのか、入居中なのかを全部屋分について連想配列にして返す関数（viewは返さない）
    public function getRoomStatuses()
    {
        // $rooms = DB::table('members')
        // ->get()

        $rooms = array(
            ['roomNum'=>101, 'status'=>'occupied', 'name'=>'ジョン'],
            ['roomNum'=>102, 'status'=>'occupied', 'name'=>'マイケル'],
            ['roomNum'=>103, 'status'=>'vacant',  'name'=>''],
            ['roomNum'=>104, 'status'=>'occupied',  'name'=>'ジェフ'],
            ['roomNum'=>105, 'status'=>'occupied',  'name'=>'ジェフ'],
            ['roomNum'=>106, 'status'=>'occupied',  'name'=>'ジェフ'],
            ['roomNum'=>107, 'status'=>'occupied',  'name'=>'ジェフ'],
            ['roomNum'=>108, 'status'=>'occupied',  'name'=>'ジェフ'],
            ['roomNum'=>109, 'status'=>'occupied',  'name'=>'ジェフ'],
            ['roomNum'=>110, 'status'=>'occupied',  'name'=>'ジェフ'],
            ['roomNum'=>111, 'status'=>'occupied',  'name'=>'ジェフ'],
        );
        return $rooms;
    }

    public function getPaymentCategories()
    {
        $categories = DB::table('payment_categories')->get();
        return $categories;
    }
}
