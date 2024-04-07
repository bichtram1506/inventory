<!-- resources/views/auth/login.blade.php -->

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required autofocus>
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div>
        <button type="submit">Đăng nhập</button>
    </div>

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
</form>
