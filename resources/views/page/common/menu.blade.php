<link rel="stylesheet" type="text/css" href="{{ asset('../page/css/main.css') }}">
<header>

<h2> Danh mục </h2>
<div class="navigation">
    <ul>
        @foreach($categories as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </ul>
</div>


</header>
