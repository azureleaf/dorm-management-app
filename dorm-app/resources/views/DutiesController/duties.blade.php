<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Laravel</title>
    <style>
        #calendar {
            border-collapse: collapse;
        }

        #calendar,
        td,
        th {
            border: 1px solid black;
            padding: 10px;
        }

        strong {
            color: red;
        }
    </style>
</head>

<body>
    <div id="app">

        <h1>風呂掃除分担</h1>
        <a href="/">Top</a>

        <!-- <form>
            <input type="date"></input>
        </form> -->

        <h2>割振除外日登録</h2>
        <ul>
        <li>風呂掃除することが<strong>できない</strong>日を選択してください。</li>
        <li>除外の希望をできる限り配慮しますが、他の人の希望状況によってはその日に割り振られる場合があります。<strong>除外日希望の少ない人ほど本来の希望が優先されます。</strong></li>
        <li>当日にできないことが判明している場合は、交代申請を出すと代わりの人が見つかることがあります。</li>
        </ul>
        <form>
        <table id="calendar">
        <tr>
            <td>日</td>
            <td>月</td>
            <td>火</td>
            <td>水</td>
            <td>木</td>
            <td>金</td>
            <td>土</td>
        </tr>
        <tr>
        @foreach($days as $day)
        <td>
            {{$day['day']}}<br>
            <input type="checkbox" name="{{$day['day']}}" value="shown">

        </td>

        @if ($day["dayOfTheWeek"] == 6)
        </tr>
        @endif
        @endforeach
        </tr>
        </table>
        <input type="submit" value="送信">

        </form>

</body>

</html>