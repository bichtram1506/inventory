<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProvisionServer;
use App\Http\Controllers\UserPostController;


Route::get('/tram', function () {
    return 'trâm';
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    require __DIR__.'/user/post.php';
    require __DIR__.'/user/user.php';
    require __DIR__.'/user/podcast.php';
    require __DIR__.'/category/category.php';
    require __DIR__.'/redis/redis.php';
    require __DIR__.'/role/role.php';
    require __DIR__.'/product/product.php';
    require __DIR__.'/order/order.php';
    require __DIR__.'/report/report.php';
});
