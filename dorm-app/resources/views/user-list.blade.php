<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <title>寮生一覧</title>
</head>

<body>
    <div id="app">
        <v-app>
            <app-header avatarurl="{{ asset('/img/rubber_ducky_material.png') }}"></app-header>
            <user-table></user-table>
            <role-table></role-table>
            <room-table></room-table>
        </v-app>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>