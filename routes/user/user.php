<?php
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\View\Composers\UserComposer;
use Illuminate\Support\Facades\View;
use App\Models\Category;


// Define routes
Route::middleware('assign.request.id')->group(function () {
    Route::resource('users', UserController::class);
    Route::post('/send-email', [UserController::class, 'sendEmail']);
});

Route::get('/users/response', [UserController::class, 'response']);

Route::post('/user/profile', function (Request $request) {
    // Xác thực dữ liệu yêu cầu
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
       
    ]);

    // Kiểm tra dữ liệu hợp lệ
    if (!$validatedData) {
        // Lưu dữ liệu và chuyển hướng đến trang khác
        return redirect('/dashboard')->with('success', 'Profile updated successfully!');
    }

    // Nếu dữ liệu không hợp lệ, chuyển hướng người dùng trở lại trang trước đó và giữ lại dữ liệu đã nhập
    return back()->withInput();
});

Route::get('/user/{user}', function (User $user) {
    return $user;
});

Route::get('/response1', function () {
    $content = 'Xin chào';
    $type = 'text/plain';

    return response($content)
        ->header('Content-Type', $type)
        ->header('X-Header-One', 'Header Value')
        ->header('X-Header-Two', 'Header Value');
});

Route::get('/example', function () {
    // Đính kèm một cookie vào phản hồi
    $response = new Response('Hello World');
    $response->cookie('name', 'value', 30); // Cookie tồn tại trong 30 phút
    
    // Sử dụng Cookie để xếp hàng cookie để đính kèm vào phản hồi
    Cookie::queue('name', 'value', 30); // Cookie tồn tại trong 30 phút
    
    // Tạo một phiên bản cookie có thể được gắn vào một phiên bản phản hồi sau này
    $cookie = cookie('name', 'value', 30); // Cookie tồn tại trong 30 phút
    $response = new Response('Hello World');
    $response->cookie($cookie);
    
    // Hết hạn cookie sớm
    $response = new Response('Hello World');
    $response->withoutCookie('name');
    
    // Hết hạn cookie bằng cách sử dụng mặt tiền Cookie
    Cookie::expire('name');
    
    return $response;
});

Route::get('/hello', function (Request $request) {
    return response()->json([
        'name' => 'Abigail',
        'state' => 'CA',
    ]);
});

Route::get('/download', [UserController::class, 'downloadFile'])->name('download.file');

View::composer('*', UserComposer::class);

View::composer('page.users.index', function ($view) {
    $view->with('category', Category::all());
});

Route::get('/', function () {
    return view('greeting')
        ->with('name', 'Victoria')
        ->with('occupation', 'Astronaut');
});

Route::get('/home', function () {
    return response('Hello World', 200)
                  ->header('Content-Type', 'text/plain');
});

Route::get('/cat/{user}', function (User $user) {
    // Get user's options attribute (which is casted as JSON)
    $names = $user->name;

    // Now $options is an associative array containing JSON data
    // Perform operations with $options as needed

    // Trả về dữ liệu dưới dạng JSON
    return response()->json([
        'user' => $user,
        'name' => $names,
    ]);
});

Route::middleware('cache.headers:public;max_age=2628000;etag')->group(function () {
    Route::get('/privacy', function () {
        return 'Hello privacy';
    });
 
    Route::get('/terms', function () {
        return 'Hello terms';
    });

    //Viết hoa
    Route::get('/uppercase/{text}', function ($text) {
        return response()->caps($text);
    });
    // Route cho việc lấy tất cả người dùng và chuyển đổi thành mảng,json
    Route::get('/users_json', [UserController::class, 'index_json_array']);
    
    Route::get('/welcome', function () {
        return view('welcome', ['name' => 'Samantha', 'array' => ['foo' => 'bar']]);
    });

    Route::get('/test_cat', function () {
    $user = User::find(5);
    return response()->json($user);
});
});
