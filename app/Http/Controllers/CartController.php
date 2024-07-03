<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Cart;


use App\Models\Product;



class CartController extends Controller
{
    public function index(Cart $cart){
        // $cartItems = $cart->list();
       

        return view('fe.cart', compact('cart'));
    }

    public function add(Request $request,Cart $cart){
        $product = Product::find($request->id);
        $quantity = $request->quantity;
        $cart->add($product,$quantity);

        return redirect() ->route('cart.index');
        // dd($request ->all());
    }
    public function removeFromCart(Request $request) {
        // Lấy productId từ yêu cầu
        $productId = $request->input('productId');
        
        // Kiểm tra nếu sản phẩm tồn tại trong giỏ hàng
        if (array_key_exists($productId, session('cart'))) {
            // Xóa sản phẩm khỏi giỏ hàng
            $cart = session('cart');
            unset($cart[$productId]);
            session(['cart' => $cart]);

            // Chuyển hướng trở lại trang trước đó với thông báo thành công
            return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
        } else {
            // Nếu sản phẩm không tồn tại trong giỏ hàng, có thể bạn muốn hiển thị một thông báo lỗi
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
        }
    }
    public function updateCartQuantity(Request $request) {
        $productId = $request->input('productId');
        $quantity = $request->input('quantity');
    
        // Cập nhật số lượng sản phẩm trong giỏ hàng
        // Ví dụ:
        $cart[$productId]['quantity'] = $quantity;
        session(['cart' => $cart]);
    
        return response()->json(['success' => true]);
    }
    

    // public function add(Request $request,Product $product,Cart $cart){
    //     $product = Product::find($request->id);
    //     $quantity = $request->quantity;
        
    //    $cartExist = Cart::where([
    //     'customer_id'=> $cus_id,
    //     'product_id'=> $product->$id
    //        ])->first();
    //        if($cartExist) -> car

    //     return redirect() ->route('cart.index');
    //     // dd($request ->all());
    // }


    
    
}
