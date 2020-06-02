@extends('layouts.base')

@section('title', '寮生一覧')
@section('content')
<user-table></user-table>
<room-table></room-table>
<!-- <room-history-table></room-history-table> -->
<role-title-table></role-title-table>
<role-history-table></role-history-table>
@endsection