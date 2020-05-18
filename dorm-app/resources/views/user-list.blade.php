@extends('layouts.base')

@section('title', '寮生一覧')
@section('content')
<user-table></user-table>
<role-table></role-table>
<room-table></room-table>
<room-history-table></room-history-table>
@endsection