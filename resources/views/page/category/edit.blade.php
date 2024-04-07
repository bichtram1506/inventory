<!-- resources/views/page/categories/edit.blade.php -->
@extends('page.layouts.page')

@section('title', 'Chỉnh sửa danh mục')

@section('style')
    @parent <!-- Kế thừa từ phần style cha -->
    <!-- Các style bổ sung cụ thể cho trang này nếu cần -->
    @push('styles')
        <link href="{{ asset('../page/css/custom.css') }}" rel="stylesheet">
    @endpush
@stop

@section('content')
    <h2>Chỉnh sửa danh mục</h2>
    <section class="content">
        <!-- Đường dẫn dẫn về trang danh sách danh mục -->
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Danh sách danh mục</a></li>
        </ul>
        
        <!-- Form chỉnh sửa danh mục -->
        @include('page.category.form')
    </section>
@stop

@section('script')
    @parent <!-- Kế thừa từ phần script cha -->
    <!-- Các scripts bổ sung cụ thể cho trang này nếu cần -->
    @push('scripts')
        <script src="{{ asset('../page/js/custom.js') }}"></script>
    @endpush
@stop
