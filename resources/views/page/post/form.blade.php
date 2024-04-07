<!-- resources/views/posts/form.blade.php -->
 <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Người dùng</a></li>
<form action="{{ isset($post) ? route('users.posts.update', ['user' => $user->id, 'post' => $post->id]) : route('users.posts.store', ['user' => $user->id]) }}" method="POST">
    @csrf
    @if(isset($post))
        @method('PUT')
    @endif
    <label for="title">Tiêu đề:</label><br>
    <input type="text" id="title" name="title" value="{{ isset($post) ? $post->title : '' }}"><br>
    <button type="submit">{{ isset($post) ? 'Cập nhật' : 'Tạo mới' }}</button>
</form>
