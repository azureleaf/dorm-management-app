<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <title>Laravel</title>
  <style>
    #header {
      font-weight: bold;
    }

    #footer {
      margin-top: 100px;
      padding-top: 20px;
      text-align: center;
      border-top: solid 1px #000000;
    }
  </style>
</head>

<body>
  <div id="app">

    <div id="header">
    @yield('header')
    </div>

    <h1>@yield('page_title')</h1>

    <div id="content">
    @yield('content')
    </div>

    <div id="footer">
    @yield('footer')
    </div>
  
  </div>
</body>

</html>