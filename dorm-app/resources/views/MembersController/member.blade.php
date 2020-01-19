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
    <h1>寮生名簿</h1>
    <a href="/">Top</a>

    <div>
        <h2>名簿編集</h2>
        <form method="POST" action="/members/add">
            {{ csrf_field()}}

            <select name="changeMemberInfo">
                <option value="default" disabled selected>編集種別を選択</option>
                <option value="joinDorm">入寮処理</option>
                <option value="leaveDorm">退寮処理</option>
                <option value="changeRoom">部屋替え</option>
                <option value="changeRole">役職修正</option>
                <option value="changeName">氏名修正</option>
                <option value="changeJoinDate">入寮日修正</option>
                <option value="changeLeaveDate">退寮日修正</option>
            </select>

            <input type="text" name="room" placeholder="部屋番号">
            <input type="text" name="lastName" placeholder="姓">
            <input type="text" name="firstName" placeholder="名">
            <input type="text" name="lastNameReading" placeholder="セイ">
            <input type="text" name="firstNameReading" placeholder="ナマエ">

            <input type="submit" value="変更登録">
        </form>
    </div>
    <div>
        <h2>寮生一覧</h2>
        <div>
            <form method="POST" action="/members">
                {{ csrf_field()}}
                <input type="checkbox" name="filterCurrentMembers" value="true" checked>在寮者を表示
                <input type="checkbox" name="filterCurrentMembers" value="true">退寮者を表示
                <input type="text" name="roomNum" placeholder="部屋番号で絞り込み">
                <input type="submit" value="表示更新">
            </form>
        </div>
        @if(count($members)==0)
        <p>指定された条件に合致する記録はありません。</p>
        @else
        <table id="paymentTable">
            <tr>
                <th>寮生番号</th>
                <th>部屋番号</th>
                <th>氏名</th>
                <th>ヨミガナ</th>
                <th>入寮日</th>
                <th>退寮日</th>
                <th>履歴</th>
            </tr>
            @foreach($members as $member)
            <tr>
                <td>{{$member->id}}</td>
                <td>{{$member->room}}</td>
                <td>{{$member->last_name}} {{$member->first_name}}</td>
                <td>{{$member->last_name_reading}} {{$member->first_name_reading}}</td>
                <td>{{$member->date_join}}</td>
                <td>{{$member->date_leave}}</td>
                <td><a href="">個人履歴</a></td>

            </tr>
            @endforeach
            @endif
        </table>

    </div>

</body>

</html>