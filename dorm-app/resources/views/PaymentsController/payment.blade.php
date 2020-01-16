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
    <h1>Payment History</h1>
    <table id="paymentTable">
        <tr>
            <th>処理番号</th>
            <th>摘要</th>
            <th>金額</th>
            <th>債務残高</th>
        </tr>
        @foreach($payments as $payment)
        <tr>
            <td>{{$payment->id}}</td>
            <td>{{$payment->description}}</td>
            <td>{{$payment->amount}}</td>
            <td>{{$payment->balance}}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>