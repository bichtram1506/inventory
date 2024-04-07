<!-- resources/views/upload.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title>
</head>
<body>
    <h2>Upload File</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="photo" accept="image/*">
        <button type="submit">Upload</button>
    </form>
</body>
</html>
