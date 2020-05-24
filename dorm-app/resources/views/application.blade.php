@extends('layouts.base')

@section('title', '日程管理')
@section('content')
<schedule-table></schedule-table>
<scheduler></scheduler>
<!-- <trade-duty></trade-duty> -->
<!-- <reporting></reporting> -->
<absence-form></absence-form>
@endsection