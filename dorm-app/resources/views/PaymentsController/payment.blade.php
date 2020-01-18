<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <style>
        #paymentTable,
        #roomsTable {
            border-collapse: collapse;
        }

        #paymentTable,
        #roomsTable,
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
            <input type="submit" value="検索">
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
            <td>部屋番号がここ</td>
            <td>氏名はここ</td>
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
            <h3>処理対象</h3>
            <input type="checkbox" name="vehicle1" value="Ah">全選択
            <input type="checkbox" name="vehicle1" value="Ah">委員会選択
            <input type="checkbox" name="vehicle1" value="Ah">選択反転

            <table id="roomsTable">
                @for ($i=0;$i < 10; $i++) <col width="120px">
                    @endfor
                    @foreach ($roomStatuses as $roomStatus)
                    @if ($loop->index % 10 == 0)
                    <tr>
                        @endif

                        <td>
                            @if ($roomStatus["status"] == 'occupied')
                            <input type="checkbox" name="vehicle1" value="Ah" checked>{{$roomStatus["roomNum"]}}
                            {{$roomStatus['name']}}
                            @else
                            <input type="checkbox" name="vehicle3" value="Boat" disabled>{{ $roomStatus["roomNum"] }}
                            @endif
                        </td>

                        @if ($loop->index % 10 == 9)
                    </tr>
                    @endif
                    @endforeach
            </table>
            <h3>処理内容</h3>
            <select>
                <option value="choose_cat" selected disabled>処理区分を選択</option>
                @foreach ($paymentCategories as $paymentCategory)
                <option value="cat{{$paymentCategory->cat_id}}">{{$paymentCategory->cat_id}}：{{$paymentCategory->cat_title}}</option>
                @endforeach
            </select>
            <input type="text" name="amount" placeholder="金額">
            <input type="text" name="description" placeholder="摘要">
            <input type="submit">
        </form>
    </div>
</body>

</html>