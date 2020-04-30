<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
</head>

<body>
    <div id="app">
        <h1>寮生一覧</h1>
        <user-table></user-table>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>