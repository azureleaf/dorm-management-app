<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <title>青葉寮申請処理</title>
</head>

<body>
    <div id="app">
        <v-app>
            <app-header avatarurl="{{ asset('/img/rubber_ducky_material.png') }}"></app-header>
            <schedule-table></schedule-table>
            <scheduler></scheduler>
            <trade-duty></trade-duty>
            <reporting></reporting>
        </v-app>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>