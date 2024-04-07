<!-- resources/views/page/users/edit.blade.php -->
@extends('page.layouts.page')

@section('title', 'Cuộc đời là những chuyến du lịch | VietScape Journeys')

@section('style')
    @parent <!-- Kế thừa từ phần style cha -->
    <!-- Các style bổ sung cụ thể cho trang này nếu cần -->
    @push('styles')
        <link href="{{ asset('../page/css/custom.css') }}" rel="stylesheet">
    @endpush
@stop

@section('content')
    <h2>Chỉnh sửa</h2>
    <section class="content">
        <!-- Để tương thích với CSS, bạn có thể sửa đổi các lớp và id của phần tử HTML -->
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Người dùng</a></li>
        </ul>
        @include('page.users.form')
    </section>
@stop

@section('script')
    @parent <!-- Kế thừa từ phần script cha -->
    <!-- Các scripts bổ sung cụ thể cho trang này nếu cần -->
    @push('scripts')
        <script src="{{ asset('../page/js/custom.js') }}"></script>
    @endpush
@stop
