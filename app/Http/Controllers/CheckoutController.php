<?php

namespace App\Http\Controllers;
use App\Helper\Cart;
use App\Models\Infor; use App\Models\Order; 
use App\Mail\OrderShipped;use Illuminate\Support\Facades\Mail;
use App\Models\Invoice; 
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function showCheckout(Cart $cart) {
        // Kiểm tra xem giỏ hàng có sản phẩm không
        if ($cart->isEmpty()) {
            // Nếu giỏ hàng trống, hiển thị thông báo
            return redirect()->back()->with('error', 'Không có sản phẩm trong giỏ hàng.');
        }
    
        // Nếu giỏ hàng không trống, tiếp tục xử lý trang thanh toán
        return view('fe.checkout', compact('cart'));
    }
    public function showCheckout_infor(Cart $cart) {
        return view('fe.checkout_infor', compact('cart'));
    }
//     public function store(Request $request)
// {
//     // Validate dữ liệu
//     $validatedData = $request->validate([
//         'name' => 'required|string|max:255',
//         'address' => 'required|string|max:255',
//         'email' => 'required|email|max:255',
//         'phone' => 'required|string|max:20',
//         // Thêm các quy tắc validation cho các trường khác nếu cần
//     ]);

//     // Lưu dữ liệu vào cơ sở dữ liệu
//     $infor = new Infor();
//     $infor->name = $validatedData['name'];
//     $infor->address = $validatedData['address'];
//     $infor->email = $validatedData['email'];
//     $infor->phone = $validatedData['phone'];
//     // Lưu dữ liệu thông tin khách hàng
//     $infor->save();
//     $infors = Infor::first(); // Lấy thông tin khách hàng từ cơ sở dữ liệu, ví dụ lấy thông tin khách hàng đầu tiên
//     $inforsId = $infors->id; // Lấy infors_id từ thông tin khách hàng

//     foreach (session('cart') as $product) {
//         $cartHD = new Invoice();
//         $cartHD->infors_id = $inforsId; // Gán infors_id từ thông tin khách hàng
//         $cartHD->product_name = $product['name'];
//         $cartHD->price = $product['price'];
//         $cartHD->quantity = $product['quantity'];
//         $cartHD->total_amount = $product['price'] * $product['quantity'];
        
//         $cartHD->save();
//     }
    
//     return redirect()->back()->with('message', 'Đơn hàng đang được xử lý');

//     // Redirect hoặc trả về response tùy thuộc vào logic của bạn
// }


// public function store(Request $request)
// {
//     // Validate dữ liệu khách hàng
//     $validatedData = $request->validate([
//         'name' => 'required|string|max:255',
//         'address' => 'required|string|max:255',
//         'email' => 'required|email|max:255',
//         'phone' => 'required|string|max:20',
//         // Thêm các quy tắc validation cho các trường khác nếu cần
//     ]);

//     // Tạo mới một bản ghi trong bảng Infor và lưu thông tin khách hàng vào
//     $infor = new Infor();
//     $infor->name = $validatedData['name'];
//     $infor->address = $validatedData['address'];
//     $infor->email = $validatedData['email'];
//     $infor->phone = $validatedData['phone'];
//     $infor->save();

//     // Lấy ID của bản ghi vừa tạo
//     $inforsId = $infor->id;

//     // Lặp qua danh sách sản phẩm trong giỏ hàng và tạo mới các bản ghi trong bảng Invoices
//     foreach (session('cart') as $product) {
//         $invoice = new Invoice();
//         $invoice->infors_id = $inforsId; // Gán infors_id từ thông tin khách hàng
//         $invoice->product_name = $product['name'];
//         $invoice->price = $product['price'];
//         $invoice->quantity = $product['quantity'];
//         $invoice->total_amount = $product['price'] * $product['quantity'];
//         $invoice->save();
//     }
//      // Gửi email
//      $email = $request->input('email');
//      $orderMail = new OrderShipped($order);
//      Mail::to($email)->send($orderMail);
    
//     // Chuyển hướng người dùng và thông báo thành công
//     return redirect()->back()->with('message', 'Đơn hàng đã được xử lý');
// }
public function store(Request $request)
{
    // Validate dữ liệu khách hàng
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        // Thêm các quy tắc validation cho các trường khác nếu cần
    ]);

    // Tạo mới một bản ghi trong bảng Infor và lưu thông tin khách hàng vào
    $infor = new Infor();
    $infor->name = $validatedData['name'];
    $infor->address = $validatedData['address'];
    $infor->email = $validatedData['email'];
    $infor->phone = $validatedData['phone'];
    $infor->save();

    // Lấy ID của bản ghi vừa tạo
    $inforsId = $infor->id;

    // Khởi tạo mảng để lưu thông tin đơn hàng
    $order = [];

    // Lặp qua danh sách sản phẩm trong giỏ hàng và tạo mới các bản ghi trong bảng Invoices
    foreach (session('cart') as $product) {
        $invoice = new Invoice();
        $invoice->infors_id = $inforsId; // Gán infors_id từ thông tin khách hàng
        $invoice->product_name = $product['name'];
        $invoice->price = $product['price'];
        $invoice->quantity = $product['quantity'];
        $invoice->total_amount = $product['price'] * $product['quantity'];
        $invoice->save();

        // Thêm thông tin sản phẩm vào mảng đơn hàng
        $order[] = [
            'product_name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $product['quantity'],
            'total_amount' => $product['price'] * $product['quantity'],
        ];
    }

    // Gửi email
    // $email = $request->input('email');
    // $orderMail = new OrderShipped($order);
    // Mail::to($email)->send($orderMail);

    // Chuyển hướng người dùng và thông báo thành công
    return redirect()->back()->with('message', 'Đơn hàng đã được xử lý. Nếu bạn muốn xuất hóa đơn hãy chọn nút bên cạnh ');
}

    
}
