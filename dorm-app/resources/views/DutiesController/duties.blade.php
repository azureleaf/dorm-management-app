<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


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
    <div id="app">

        <h1>風呂掃除分担</h1>
        <a href="/">Top</a>

        <form>
            <input type="date"></input>
        </form>
</body>

</html>