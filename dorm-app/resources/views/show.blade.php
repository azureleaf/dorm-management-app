<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
　　　<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="/css/styles.css">
　</head>
　　　<body>
      <div class="container">
　　　<div id="app">
  　　　<nav>
    　　　<ul>
      　　　<router-link :to="{ name: 'intro' }" exact>Intro</router-link>
    　　　</ul>
  　　　</nav>
  　　　<router-view></router-view>
 　　　</div>


    </body>
  <script src="{{ mix('js/app.js') }}"></script>
</html>