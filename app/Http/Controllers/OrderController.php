<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use App\Models\Infor;

use Illuminate\Support\Facades\Mail;
class OrderController extends Controller
{
    public function sendEmail(Order $order)
    {
        // Tạo một instance của Mailable với thông tin đơn hàng
        $email = new OrderShipped($order);

        // Gửi email
        Mail::to($order->customer_email)->send($email);

        return "Email đã được gửi đi thành công!";
    }
    public function process(Request $request)
    {
        // Lưu đơn hàng vào CSDL (Nếu cần)
        $order = new Infor();
        // Lưu các thông tin khác của đơn hàng

        // Gửi email
        $email = $request->input('email');
        $orderMail = new OrderShipped($order);
        Mail::to($email)->send($orderMail);

        return "Đơn hàng đã được xử lý và email đã được gửi đi.";
    }
}
