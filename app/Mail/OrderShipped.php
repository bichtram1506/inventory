<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable implements ShouldQueue // Lớp OrderShipped kế thừa từ Mailable và implements ShouldQueue để có thể xử lý hàng đợi
{
    use Queueable, SerializesModels; // Sử dụng các tính năng của Queueable và SerializesModels traits

    public Order $order; // Khai báo một thuộc tính public là $order thuộc kiểu Order

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order) // Hàm khởi tạo, chấp nhận một tham số kiểu Order
    {
        $this->order = $order; // Gán giá trị tham số vào thuộc tính $order của lớp
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content // Phương thức trả về định nghĩa nội dung của email
    {
        return new Content( // Trả về một đối tượng Content
            markdown: 'mail.orders.shipped', // Sử dụng markdown file 'mail.orders.shipped' cho nội dung của email
            with: [
                'orderId' => $this->order->id, // Truyền giá trị của thuộc tính id từ đối tượng $order vào mảng with
            ],
        );
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope // Phương thức trả về định nghĩa về bao gói của email
    {
        return new Envelope( // Trả về một đối tượng Envelope
            subject: 'Order Shipped', // Chủ đề của email
            tags: ['shipment'], // Thẻ của email
            metadata: [
                'order_id' => $this->order->id, // Thêm metadata với key là 'order_id' và giá trị là id của order
            ],
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
   public function build() // Phương thức build để xây dựng email
   {
       return $this->content(); // Trả về nội dung của email
    }
    
    /* public function build()
    {
        return $this->subject('Order Shipped')
                    ->markdown('mail.orders.shipped')
                    ->with([
                        'orderId' => $this->order->id,
                    ])
                    ->queue();
    }*/


    
}
