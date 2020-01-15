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
            <input type="text" name="roomNum" placeholder="部屋番号を入力">
            <input type="submit">
        </form>
    </div>
    @if(count($members)==0)
    <p>指定された条件に合致する記録はありません。</p>
    @else
    <table id="paymentTable">
        <tr>
            <th>寮生識別番号</th>
            <th>部屋番号</th>
            <th>氏名</th>
        </tr>        
        @foreach($members as $member)
        <tr>
            <td>{{$member->id}}</td>
            <td>{{$member->room}}</td>
            <td>{{$member->name}}</td>
        </tr>
        @endforeach
        @endif
    </table>
</body>

</html>