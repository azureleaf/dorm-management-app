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
    <h1>寮生一覧</h1>
    <div>
        <form method="POST" action="/members">
            {{ csrf_field()}}
            <input type="text" name="memberID">
            <input type="submit">
        </form>
    </div>
    {{ $members }}

    <table id="paymentTable">
        <tr>
            <th>寮生識別番号</th>
            <th>部屋番号</th>
            <th>氏名</th>
        </tr>
    </table>
</body>

</html>