<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <style>
        #paymentTable {
            border-collapse: collapse;
        }

        #paymentTable,
        td,
        th {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h1>寮費処理</h1>
    <div>
        <h2>寮費履歴</h2>
        <form method="POST" action="/payments/single">
            {{ csrf_field()}}
            <input type="text" name="member_id" placeholder="寮生番号">
            <input type="submit" value="検索">
        </form>
    </div>
    <table id="paymentTable">
        <tr>
            <th>処理番号</th>
            <th>処理日時</th>
            <th>寮生番号</th>
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
    <div>
        <h2>個別処理登録</h2>
        <form method="POST" action="/payments/single">
            {{ csrf_field()}}
            <input type="text" name="member_id" placeholder="寮生番号">
            <input type="text" name="amount" placeholder="金額">
            <input type="text" name="description" placeholder="摘要">
            <input type="submit">
        </form>
    </div>
    <div>
        <h2>一括処理登録</h2>
        <form method="POST" action="/payments/single">
            {{ csrf_field()}}
            <input type="text" name="member_id" placeholder="部屋番号一括（カンマ区切り）">
            <input type="text" name="amount" placeholder="金額">
            <input type="text" name="description" placeholder="摘要">
            <input type="submit">
        </form>
    </div>
</body>

</html>