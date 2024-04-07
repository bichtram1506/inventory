<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Session;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('page.auth.login');
    }

    public function login(Request $request)
 {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Đăng nhập thành công
        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;

        // Lưu trữ token vào session
        Session::put('authToken', $token);

        // Lưu thông báo thành công vào session
        $request->session()->flash('success', 'Bạn đã đăng nhập thành công.');

   
        return redirect()->route('users.index');
    }

    // Đăng nhập không thành công
    return redirect()->route('login')->withErrors(['email' => 'Thông tin đăng nhập không hợp lệ.']);
}


    public function logout(Request $request)
    {
        Auth::logout();

        // Chuyển hướng về trang đăng nhập sau khi đăng xuất
        return redirect()->route('login');
    }
}
