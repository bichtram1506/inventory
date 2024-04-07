@extends('page.layouts.page')
@section('title', 'Cuộc đời là những chuyến du lịch | VietScape Journeys')
@section('style')
@stop
@section('content')

<h2>Thêm</h2>
 <section class="content">
   <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Người dùng</a></li>
        @include('page.users.form')
    </section>
    
    @stop
@section('script')
@stop
