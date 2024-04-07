<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;

class ShipOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $userId;
    public $productId;

    /**
     * Create a new job instance.
     *
     * @param int $userId
     * @param int $productId
     * @return void
     */
    public function __construct($userId, $productId)
    {
        $this->userId = $userId;
        $this->productId = $productId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Xây dựng đối tượng Order từ dữ liệu được cung cấp
        $order = new Order();
        $order->user_id = $this->userId;
        $order->product_id = $this->productId;
        $order->save();

        // Gửi email xác nhận đơn hàng
        $userEmail = 'tramle15062000@gmail.com'; // Thay thế bằng địa chỉ email của người dùng
        $orderNumber = '12345'; // Thay thế bằng số đơn hàng hoặc thông tin khác liên quan
        Mail::to($userEmail)->send(new OrderShipped($order));

        // Cập nhật trạng thái đơn hàng
        // Trong trường hợp này, vì chúng ta không có thông tin đơn hàng từ cơ sở dữ liệu,
        // nên chúng ta chỉ mô phỏng việc cập nhật trạng thái đơn hàng bằng cách ghi log hoặc báo cáo
        info('Order shipped for User ID: ' . $this->userId . ', Product ID: ' . $this->productId);
    }
}
