<!DOCTYPE html>
<!-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> -->
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <title>@yield('title') - 青葉大学青葉寮</title>
</head>

<body>
    <div id="app2">
        <v-app>
            <!-- <app-header avatarurl="{{ asset('/img/rubber_ducky_material.png') }}"></app-header> -->
            <app-header></app-header>
            @yield('content')
        </v-app>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>