<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
@section('content')
    <div class="container">
        <h1>Welcome to our website!</h1>
    </div>
@endsection

@push('styles')
    <style>
        body {
            background-color: #000000;
            font-family: Arial, sans-serif;
        }
    </style>
@endpush

@push('scripts')
    <script>
        alert('Xin chào! Đây là một script JavaScript.');
    </script>
@endpush
<body>
    <h1>Hello, {{ $name }}.</h1>

    <p>The current UNIX timestamp is {{ time() }}.</p>

    <p>Hello, {!! $name !!}.</p>

    <h2>Rendering JSON:</h2>{!! json_encode($array) !!}
    <script>
    var app = {!! json_encode($array) !!};
    console.log(app);
</script>

</body>
</html>
