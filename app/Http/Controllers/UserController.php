<?php
namespace App\Http\Controllers;

use App\Services\UserService;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Http\Requests\UserRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;
use App\Mail\OrderShipped;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request): View
{
    try {
        // Ghi log thông tin
        Log::info('This is an informational message.');

        // Ghi log thông tin vào kênh 'slack'
        Log::channel('slack')->info('Something happened!');

        // Sử dụng ngăn xếp log với các kênh 'single' và 'slack'
        Log::stack(['single', 'slack'])->info('Something happened!');

        // Ghi log thông tin vào kênh tùy chỉnh 'example-custom-channel'
        Log::channel('example-custom-channel')->info('This is a custom log message.');

        // Xây dựng một kênh log tùy chỉnh
        $channel = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/custom.log'),
        ]);

        // Sử dụng ngăn xếp log với kênh 'slack' và kênh tùy chỉnh được xây dựng
        Log::stack(['slack', $channel])->info('Something happened!');

        // Gọi userService để lấy danh sách người dùng
        $users = $this->userService->getAllUsersPaginated(NUMBER_PAGINATION);

        $categories = Category::all();
        $menuHtml = view()->make('page.common.menu', ['categories' => $categories])->render();

        return view('page.user.index', compact('users', 'menuHtml'));
    } catch (\Exception $e) {
        // Ghi log với các mức độ lỗi khác nhau
        Log::emergency('An emergency occurred: ' . $e->getMessage());
        Log::alert('An alert occurred: ' . $e->getMessage());
        Log::critical('A critical error occurred: ' . $e->getMessage());
        Log::error('An error occurred: ' . $e->getMessage());
        Log::warning('A warning occurred: ' . $e->getMessage());
        Log::notice('A notice occurred: ' . $e->getMessage());
        Log::debug('A debug message: ' . $e->getMessage());

        // Ghi log vào tệp tin cụ thể
        $channel = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/custom.log'),
        ]);
        Log::stack(['slack', $channel])->error('An error occurred: ' . $e->getMessage());

        return view('errors.404'); 
    }
}


    public function show(Request $request, $id): View
    {
        // Ghi log trước khi hiển thị trang hồ sơ người dùng
        Log::info('Showing user profile for user {id}', ['id' => $id]);

        // Lấy thông tin người dùng từ UserService
        $user = $this->userService->getUserById($id);

        // Lấy giá trị từ session
        $value = $request->session()->has('key') ? $request->session()->get('key') : null;

        // Trả về view hiển thị trang hồ sơ người dùng với dữ liệu của người dùng và giá trị từ session
        return view('page.auth.profile', ['user' => $user, 'value' => $value]);
    }

    public function create(): View
    {
        return view('page.users.create');
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($request->password);
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validatedData['avatar'] = $avatarPath;
        }
        $this->userService->createUser($validatedData);
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(string $id): View
    {
        $user = $this->userService->getUserById($id);
        return view('page.user.edit', compact('user'));
    }

    public function update(UserRequest $request, string $id): RedirectResponse
    {
        $user = $this->userService->getUserById($id);
        $validatedData = $request->validated();
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validatedData['avatar'] = $avatarPath;
        }
        $this->userService->updateUser($id, $validatedData);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->userService->deleteUser($id);
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function response()
    {
        return response('Hello World', 200)
            ->header('Content-Type', 'text/plain');
    }

    
    public function downloadFile()
    {
        $pathToFile = public_path('files/file.pdf'); // Đường dẫn tới tệp tin cần tải xuống
        $name = 'file.pdf'; // Tên tệp tin sẽ hiển thị khi tải xuống

        return response()->download($pathToFile, $name);
    }
    

        public function index_json_array()
    {
        $user = User::find(5);
        
        if (!$user) {
            return response()->json(['error' => 'Người dùng không tồn tại'], 404);
        }
        
        // Chuyển đổi người dùng thành mảng
        $userArray = $user->toArray();

        // Chuyển đổi một người dùng sang JSON
        $userJson = $user->toJson();

        // Chuyển đổi một người dùng sang JSON với định dạng đẹp
        $userJsonPretty = $user->toJson(JSON_PRETTY_PRINT);

        return response()->json([
            'userArray' => $userArray,
            'userJsonPretty' => $userJsonPretty,
            'userJson' => $userJson
        ]);
    }


    
  }
