<!-- resources/views/posts/index.blade.php -->
@extends('page.layouts.page')
@section('title', 'Cuộc đời là những chuyến du lịch | VietScape Journeys')
@section('style')
    <style>
        /* CSS tùy chỉnh cho trang danh sách bài viết */
        .btn-action {
            margin-left: 10px;
        }
        .btn-edit {
            margin-right: 5px;
        }
        .btn-delete {
            margin-right: 5px;
        }
    </style>
@stop

@section('content')
    <div class="container mt-4">
     <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Người dùng</a></li>
        <h1>Danh sách bài viết</h1>
        <ul class="list-group mt-3">
            @foreach ($posts as $post)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $post->title }}
                    <div class="btn-group" role="group" aria-label="Actions">
                        <a href="{{ route('users.posts.edit', ['user' => $user->id, 'post' => $post->id]) }}" class="btn btn-primary btn-action btn-edit">Sửa</a>
                        <form method="POST" action="{{ route('users.posts.destroy', ['user' => $user->id, 'post' => $post->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-action btn-delete">Xóa</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
        <a href="{{ route('users.posts.create', ['user' => $user->id]) }}" class="btn btn-success mt-3">Thêm mới</a>
    </div>
@stop

@section('script')
@stop
