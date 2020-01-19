<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <style>
        #paymentTable,
        #roomsTable,
        #leftMembersTable {
            border-collapse: collapse;
        }

        #paymentTable,
        #roomsTable,
        #leftMembersTable,
        td,
        th {
            border: 1px solid black;
        }
    </style>
</head>

<body>

    <h1>寮費請求</h1>
    <a href="/">Top</a>

    <div>
        <h2>寮費履歴</h2>
        <form method="POST" action="/payments/filtered">
            {{ csrf_field()}}
            <input type="text" name="member_id" placeholder="寮生番号">
            <input type="submit" value="この寮生のみ表示">
        </form>
    </div>
    @if (count($payments) != 0)
    <table id="paymentTable">
        <tr>
            <th>処理番号</th>
            <th>処理日時</th>
            <th>寮生番号</th>
            <th>部屋番号</th>
            <th>氏名</th>
            <th>寮費種別</th>
            <th>摘要</th>
            <th>請求額</th>
            <th>支払額</th>
            <th>請求残高</th>
        </tr>
        @foreach($payments as $payment)
        <tr>
            <td>{{$payment->id}}</td>
            <td>{{$payment->date}}</td>
            <td>{{$payment->member_id}}</td>
            <td>{{$payment->room}}</td>
            <td>{{$payment->last_name}} {{$payment->first_name}}</td>
            <td>{{$payment->payment_category_id}}：{{$payment->cat_title}}</td>
            <td>{{$payment->description}}</td>
            @if ($payment->amount >= 0)
            <td>{{$payment->amount}}</td>
            <td></td>
            @else
            <td></td>
            <td>{{$payment->amount}}</td>
            @endif
            <td>{{$payment->balance}}</td>
        </tr>
        @endforeach


    </table>
    @else
    <div>該当する寮生は存在しません</div>
    @endif

    <div>

        <h2>会計処理登録</h2>
        <form method="POST" action="/payments/register">
            {{ csrf_field()}}
            <h3>在寮者</h3>
            <span>件中件が選択されています</span>

            <input type="checkbox" name="checkAll" value="true">全選択
            <input type="checkbox" name="reverseChecks" value="true">選択反転

            <table id="roomsTable">
                {{--テーブル幅の設定--}}
                @for ($i=0;$i < 10; $i++) <col width="120px">
                    @endfor

                    @foreach ($rooms as $room)

                    {{--表の幅を１０列とする（行開始タグ側）--}}
                    @if ($loop->index % 10 == 0)
                    <tr>
                        @endif

                        {{--空室のチェックボックスは選択できないようにする--}}
                        @if (!$room["isVacant"])
                        <td><input type="checkbox" name="{{$room['roomNum']}}" value="checked" checked>{{$room["roomNum"]}} {{$room["name"]}}</td>
                        @else
                        <td style="background-color: silver"><input type="checkbox" name="{{$room['roomNum']}}" value="checked" disabled>{{ $room["roomNum"] }}</td>
                        @endif

                        {{--表の幅を１０列とする（行終了タグ側）--}}
                        @if ($loop->index % 10 == 9)
                    </tr>
                    @endif

                    @endforeach
            </table>

            <select>
                <option value=" choose_cat" selected disabled>処理区分を選択</option>
                @foreach ($paymentCategories as $paymentCategory)
                <option value="{{$paymentCategory->cat_id}}">{{$paymentCategory->cat_id}}：{{$paymentCategory->cat_title}}</option>
                @endforeach
            </select>
            <input type="text" name="amount" placeholder="金額">
            <input type="text" name="description" placeholder="摘要">
            <input type="submit" value="会計処理登録">
        </form>
        <h3>退寮者</h3>
        <form method="POST" action="/payments/register">
            {{ csrf_field()}}

            <table id="leftMembersTable">
                <tr>
                    <th>寮生番号</th>
                    <th>氏名</th>
                    <th>退寮日</th>
                    <th>滞納額</th>
                    <th>支払額</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>あああ</td>
                    <td>あああ</td>
                    <td>あああ</td>
                    <td><input type="text" name="amount" placeholder="金額"></td>
                </tr>
            </table>

            <input type="submit" value="退寮者の支払登録">
        </form>
    </div>
</body>

</html>