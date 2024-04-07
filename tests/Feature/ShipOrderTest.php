<?php

namespace Tests\Feature;

use App\Jobs\ShipOrder;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
class ShipOrderTest extends TestCase
{
    /**
     * Test that ShipOrder job sends order confirmation email.
     *
     * @return void
     */
    public function test_ship_order_sends_email()
{
   
    Mail::fake(); // Giả mạo chức năng gửi email

    $userId = 1;
    $productId = 123;
    $userEmail = 'tramle15062000@gmail.com'; // Địa chỉ email cố định

    // Gửi công việc vào hàng đợi
    ShipOrder::dispatch($userId, $productId);
    // Xác nhận rằng email đã được gửi
    Mail::assertQueued(OrderShipped::class, function ($mail) use ($userId, $productId) {
    return $mail->order->user_id === $userId &&
           $mail->order->product_id === $productId;
});

}

}
