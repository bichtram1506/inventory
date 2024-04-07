<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Report</title>
        @push('styles')
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }
        h1, h2, h3 {
            margin-top: 30px;
        }
        hr {
            border: 1px solid #ccc;
        }
    </style>
    @endpush
   
</head>
<body>

<div class="container">
 <h1>Users Updated After Creation</h1>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>Updated At</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users_up as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <h1>User Count: {{ $users_count }}</h1>
    <h1>Max Price: {{ $price }}</h1>

    <h2>User Orders</h2>
    @foreach($results as $result)
        <div>
            <p>User Name: {{ $result->name }}</p>
            <p>User Email: {{ $result->email }}</p>
            <p>Order ID: {{ $result->id }}</p>
            <p>Order Price: {{ $result->price }}</p>
            <!-- Hiển thị các thông tin khác của đơn đặt hàng nếu cần -->
            <hr>
        </div>
    @endforeach

    <h2>User Orders Grouped by User</h2>
    @foreach($results_gb as $result)
        <div>
            <p>User ID: {{ $result->id }}</p>
            <p>User Name: {{ $result->name }}</p>
            <p>Order Count: {{ $result->order_count }}</p>
            <hr>
        </div>
    @endforeach

    <h1>User Report</h1>

    <h2>Thêm các thuộc tính ảo cho table</h2>
    <table>
        <thead>
            <tr>
                <th>Team</th>
                <th>Admin Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users2 as $user)
            <tr>
                <td>{{ $user->team }}</td> <!-- Hiển thị thuộc tính ảo "team" -->
                <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td> <!-- Hiển thị thuộc tính ảo "is_admin" -->
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Kiểm tra sự tồn tại</h2>
    @if($containsUser)
        <p>Hiển thị nội dung nếu $containsUser là true</p>
    @endif
    @if($containsUserModel)
        <p>Hiển thị nội dung nếu $containsUserModel là true</p>
    @endif

    <h2>Hiển thị tất cả user trừ user id 1, 2, 3</h2>
    @foreach ($diffUsers as $user)
        <p>User ID: {{ $user->id }}</p>
        <p>User Name: {{ $user->name }}</p>
        <!-- Hiển thị các thuộc tính khác của người dùng -->
    @endforeach

    <h2>Phương thức except trừ user 4, 5</h2>
    @foreach ($exceptUsers as $user)
        <p>User ID: {{ $user->id }}</p>
        <p>User Name: {{ $user->name }}</p>
        <!-- Hiển thị các thuộc tính khác của người dùng -->
    @endforeach

    <h2>Phương thức fresh lấy dữ liệu mới nhất từ CSDL</h2>
    @foreach ($fresh as $user)
        <p>User ID: {{ $user->id }}</p>
        <p>User Name: {{ $user->name }}</p>
        <!-- Hiển thị các thuộc tính khác của người dùng -->
    @endforeach

    <h2>Phương thức intersect lấy user 6, 7, 8</h2>
    @foreach ($intersectUsers as $user)
        <p>User ID: {{ $user->id }}</p>
        <p>User Name: {{ $user->name }}</p>
        <!-- Hiển thị các thuộc tính khác của người dùng -->
    @endforeach

    <h2>Phương thức load</h2>
    @foreach ($user_post as $user)
        <h2>{{ $user->name }}</h2>
        <h3>Posts:</h3>
        <ul>
            @foreach ($user->posts as $post)
                <li>{{ $post->title }}</li>
            @endforeach
        </ul>
    @endforeach

    <h2>Phương thức loadmiss</h2>
    @foreach ($user_miss as $user)
        <h2>{{ $user->name }}</h2>
        <h3>Posts:</h3>
        <ul>
            @foreach ($user->posts as $post)
                <li>{{ $post->title }}</li>
            @endforeach
        </ul>
    @endforeach

    <h2>Hiển thị các thuộc tính address và phone_number đã được làm hiển thị</h2>
    @foreach($users_makeVi as $user)
        <p>User ID: {{ $user->id }}</p>
        <p>User Name: {{ $user->name }}</p>
        <p>User Address: {{ $user->address }}</p>
        <p>User Phone Number: {{ $user->phone_number }}</p>
    @endforeach

    <h2>Hiển thị các thuộc tính address và phone_number đã được ẩn đi</h2>
    @foreach($users_make as $user)
        <p>User ID: {{ $user->id }}</p>
        <p>User Name: {{ $user->name }}</p>
        <!-- Các thuộc tính address và phone_number sẽ không hiển thị -->
    @endforeach

    <h2>Chỉ hiển thị các user có ID là 1, 2 hoặc 3</h2>
    @foreach($users_only as $user)
        <p>User ID: {{ $user->id }}</p>
        <p>User Name: {{ $user->name }}</p>
    @endforeach

    <h2>Chỉ hiển thị các thuộc tính id và name</h2>
    @foreach($users_setVi as $user)
        <p>User ID: {{ $user->id }}</p>
        <p>User Name: {{ $user->name }}</p>
        <!-- Các thuộc tính khác không hiển thị -->
    @endforeach

    <h2>Hiển thị danh sách người dùng với các trường đã ẩn</h2>
    <p>Users with Hidden Fields Set:</p>
    @foreach($users_hidd as $hiddenSetUser)
        <p>{{ $hiddenSetUser->id }}</p>
    @endforeach

    {{-- Thực hiện câu truy vấn cập nhật trạng thái của người dùng --}}
    {{-- (chú ý: đây là một hành động thay đổi dữ liệu và không phù hợp trong một view) --}}
    {{-- <p>{{ $query }}</p> --}}

    <h2>Hiển thị danh sách người dùng duy nhất</h2>
    <p>Unique Users:</p>
    @foreach($uniqueUsers as $uniqueUser)
        <p>{{ $uniqueUser->name }}</p>
    @endforeach

</div>

</body>
</html>
