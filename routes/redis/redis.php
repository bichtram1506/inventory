<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedisController;
use Illuminate\Support\Facades\Redis;
Route::get('/redis', [RedisController::class, 'redis']);
Route::get('/test-redis', function () {
    // Lưu trữ một giá trị vào Redis
    Redis::set('name', 'Taylor');

    // Lấy giá trị từ Redis
    $name = Redis::get('name');

    // In ra giá trị đã lưu
    echo $name;
});
Route::get('/publish', function () {
    // Gửi tin nhắn đến kênh "test-channel"
    Redis::publish('test-channel', json_encode([
        'name' => 'Adam Wathan'
    ]));

});