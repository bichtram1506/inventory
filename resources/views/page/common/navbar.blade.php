<nav class="main-header navbar navbar-expand navbar-dark navbar-info">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
        <!-- Breadcrumbs -->
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Quản lý danh mục</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Quản lý vai trò</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Sản phẩm</a></li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
         
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="https://khoinguonsangtao.vn/wp-content/uploads/2022/07/avatar-cute-2-560x560.jpg" class="small-avatar" alt="User Image">
                <span class="d-none d-md-inline">  
     {{-- Sử dụng @auth và @guest để kiểm tra xem người dùng đã đăng nhập chưa --}}
    @php 
    $user = Auth::user(); // Lấy thông tin người dùng đang đăng nhập
    @endphp

    @auth
        <p>Xin chào, {{ $user->name }}!</p>
    @endauth


        @guest
            <p>Bạn chưa đăng nhập.</p>
        @endguest</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="https://khoinguonsangtao.vn/wp-content/uploads/2022/07/avatar-cute-2-560x560.jpg"class="small-avatar" alt="User Image">
                    <p>
                        {!! isset($user->name) ? $user->name : '' !!}
                        <small>{!! isset($user->email) ? $user->email : '' !!}</small>
                     
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="#" class="btn btn-default btn-flat">Tài khoản</a>
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right">Đăng xuất</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>