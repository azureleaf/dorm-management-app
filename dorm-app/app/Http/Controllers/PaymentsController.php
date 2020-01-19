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
            // payments表から、members表とpayment_categories表にそれぞれidで関連付けているのでjoinする
            'payments' => DB::table('payments')
                ->join('members', 'member_id', '=', 'members.id')
                ->join('payment_categories', 'payment_category_id', '=', 'payment_categories.cat_id')
                ->select('payments.*', 'members.last_name', 'members.first_name', 'members.room', 'payment_categories.cat_title')
                ->get(),
            'rooms' => $this->getRooms(),
            'paymentCategories' => $this->getPaymentCategories()
        ];
        return view('PaymentsController.payment', $data);
    }

    // Show the payments for the specified user
    public function showFiltered(Request $request)
    {
        if ($request->member_id == '') {
            // 検索条件が空欄の場合には、全ての支払い記録を表示する
            return redirect()->action('PaymentsController@showAll');
        }
        $data = [
            // payments表から、members表とpayment_categories表にそれぞれidで関連付けているのでjoinする
            'payments' => DB::table('payments')
                ->join('members', 'member_id', '=', 'members.id')
                ->join('payment_categories', 'payment_category_id', '=', 'payment_categories.cat_id')
                ->select('payments.*', 'members.last_name', 'members.first_name', 'members.room', 'payment_categories.cat_title')
                ->where('member_id', '=', $request->member_id)
                ->get(),
            'rooms' => $this->getRooms(),
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

    // 部屋が空室なのか、入居中なのか、その状態全ての部屋について連想配列で返す
    public function getRooms()
    {
        // 全部屋の部屋番号の取得
        $occupiedRoomsCollection = DB::table('members')
            ->select('room', 'first_name', 'last_name')
            ->get();

        // Collectionから部屋番号のみ取り出して通常の配列にする
        $occupiedRooms = array();
        foreach ($occupiedRoomsCollection as $occupiedRoom) {
            array_push($occupiedRooms, $occupiedRoom->room);
        };

        // 空き部屋を含めた全部屋の連想配列を作成
        // １階と２階のそれぞれに40号室まで存在することを想定
        $rooms = array();
        for ($i = 0; $i < 40; $i++) {
            array_push(
                $rooms,
                array('roomNum' => 101 + $i, 'isVacant' => true),
                array('roomNum' => 201 + $i, 'isVacant' => true)
            );
        };

        // 部屋番号順に並び替え
        usort($rooms, function ($roomA, $roomB) {
            return $roomA["roomNum"] > $roomB["roomNum"];
        });

        // 居住している部屋については状態を変更
        // $roomが参照になっている点に注意
        foreach ($rooms as &$room) {
            if (in_array($room['roomNum'], $occupiedRooms)) {

                // 空室フラグを落とす
                $room['isVacant'] = false;

                // 居住者の氏名を連想配列に追加
                $targetMember = $occupiedRoomsCollection
                    ->where('room', $room['roomNum'])
                    ->first();
                $room['name'] = $targetMember->last_name . $targetMember->first_name;
            }
        };

        // 参照を破壊する（Recommended to do so in the official PHP doc）
        unset($room);

        return $rooms;
    }

    // DBの寮費支払区分のテーブルから、区分の一覧を取得して返す
    public function getPaymentCategories()
    {
        $categories = DB::table('payment_categories')->get();
        return $categories;
    }
}
