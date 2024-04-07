<?php
use App\Http\Controllers\OrderController;


use App\Models\Order;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Route;

//xem trước  temblade mail
Route::get('/mailable', function () {
    $order = Order::find(1);

    return new OrderShipped($order);
});
Route::resource('orders', OrderController::class);