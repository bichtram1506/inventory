<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Mail\OrderShipped;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách các đơn hàng.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    /**
     * Lưu một đơn hàng mới.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Lấy thông tin từ request
    $userId = $request->userId;
    $productId = $request->productId;

    // Tạo mới đơn hàng
    $order = new Order();
    $order->user_id = $userId;
    $order->product_id = $productId;
    $order->save();

    // Tìm người dùng
    $user = User::find($userId);

    // Nếu người dùng tồn tại
    if ($user) {
        // Lấy địa chỉ email của người dùng
        $email = $user->email;

        // Lấy ngôn ngữ ưu tiên của người dùng
        $preferredLocale = $user->preferredLocale();

        // Địa chỉ email của người nhận CC và BCC
        $ccUsers = ['tram23032001@gmail.com'];
        $bccUsers = ['thiahid@gmail.com'];

        // Gửi email tới địa chỉ email của người dùng với CC (Carbon Copy) và BCC (Blind Carbon Copy)
        Mail::to($email)
            ->cc($ccUsers)
            ->bcc($bccUsers)
            ->locale($preferredLocale)
            ->queue(new OrderShipped($order)); // Sử dụng hàng đợi để gửi email

        return response()->json(['message' => 'Email sent successfully and order created'], 200);
    } else {
        return response()->json(['message' => 'User not found'], 404);
    }
}




    /**
     * Hiển thị thông tin một đơn hàng cụ thể.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order);
    }

    /**
     * Cập nhật thông tin một đơn hàng.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return response()->json($order, 200);
    }

    /**
     * Xóa một đơn hàng.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(null, 204);
    }
}
