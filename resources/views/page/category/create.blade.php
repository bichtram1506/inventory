@extends('page.layouts.page')
@section('title', 'Cuộc đời là những chuyến du lịch | VietScape Journeys')
@section('style')
@stop
@section('content')

<h2>Thêm</h2>
 <section class="content">
   <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Danh mục</a></li>
        @include('page.category.form')
    </section>
    
    @stop
@section('script')
@stop
