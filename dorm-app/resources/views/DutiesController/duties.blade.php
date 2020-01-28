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

        th {
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
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

        <h2>当番割振の除外希望日を登録</h2>
        <ul>
            <li>風呂掃除することが<strong>できない</strong>日を選択してください。</li>
            <li>除外の希望をできる限り配慮しますが、他の人の希望状況によってはやむを得ず割り振られる場合があります。この場合、<strong>除外希望の日が少ない人ほど本来の希望が優先されます。</strong></li>
            <li>割り振られた日に実施できないことが判明している場合は、事前に<a href="">交代申請</a>を出すと代わりの人が見つかることがあります。</li>
        </ul>
        <form>
            <table id="calendar">
                <tr>
                    <th>日</th>
                    <th>月</th>
                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                    <th>土</th>
                </tr>
                @foreach($days as $day)

                @if ( $day["dayOfTheWeek"] == 0 || $loop->first)
                <tr>
                    @endif

                    {{--初日が日曜日ではないときには初日まで空白を挿入する--}}
                    @if ( $loop->first)
                    @for ($i = 0; $i < $day["dayOfTheWeek"]; $i++) <td>
                        </td>
                        @endfor
                        @endif

                        <td>
                            <label for="day{{$day['day']}}">
                                <input type="checkbox" id="day{{$day['day']}}" name="{{$day['day']}}" value="checked">
                                {{$day['day']}}
                            </label>
                        </td>

                        @if ($day["dayOfTheWeek"] == 6 || $loop->last)
                </tr>
                @endif
                @endforeach
            </table>
            <input type="submit" value="上記で除外希望を提出">

        </form>

</body>

</html>