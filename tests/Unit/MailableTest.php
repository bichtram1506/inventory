<?php
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use App\Models\Order;
use App\Jobs\ShipOrder;

class MailableTest extends TestCase
{
    public function test_orders_can_be_shipped(): void
    {
        // Giả mạo chức năng gửi email
        Mail::fake();

        $userId = 1;
        $productId = 123;
        $userEmail = 'tramle15062000@gmail.com';

        // Dispatch công việc ShipOrder
        ShipOrder::dispatch($userId, $productId);

        // Kiểm tra rằng mailable OrderShipped được đưa vào hàng đợi
        Mail::assertQueued(OrderShipped::class, function ($mail) use ($userEmail) {
            return $mail->hasTo($userEmail);
        });
    }
}
