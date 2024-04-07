<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'VietScapeJourneys - Lựa chọn hàng đầu cho TOUR DU LỊCH trực tuyến tại Việt Nam')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('page.common.header')
    @stack('styles') <!-- Đưa vào stack các đoạn mã CSS -->
</head>

<body class="container">
   <!-- Sử dụng Blade Component Navigation -->
    <x-navigation />
    @include('page.common.navbar')
    @yield('content')
    @include('page.common.footer')
    @include('page.common.script')
    @stack('scripts') <!-- Đưa vào stack các đoạn mã JavaScript -->
</body>


</html>
