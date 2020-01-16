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
    <h1>寮生管理</h1>
    <div>
        <h2>寮生記録一覧</h2>
        <div>
            <form method="POST" action="/members">
                {{ csrf_field()}}
                <input type="text" name="roomNum" placeholder="部屋番号で絞り込み">
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

    </div>
    <div>
        <h2>新寮生情報の追加</h2>
        <form method="POST" action="/members/add">
            {{ csrf_field()}}
            <input type="text" name="room" placeholder="新寮生の部屋番号">
            <input type="text" name="name" placeholder="新寮生の氏名">
            <input type="submit">
        </form>
    </div>
</body>

</html>