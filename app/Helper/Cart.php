<?php

namespace App\Helper;
use App\Models\Cart as CartModel;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
class Cart{
    private $items= [];
    private $total_quantity = 0;
    private $total_price = 0;

    public function __construct(){
        $this->items = session('cart') ?  session('cart') : [];

    }
    public function list(){
       return $this->items;
    }
    //them moi san pham
    public function add($product, $quantity = 1){
        $item = [
        'productId' => $product->id,
        'name' => $product->name,
        'price' =>$product -> sale_price > 0 ? $product -> sale_price : $product->price,
        'image' => $product ->image,
        'quantity'=> $quantity
        
        ] ;
        $this->items[$product->id]=$item;
        session(['cart'=>$this->items]);
        // Cart::create($item);
    }
    public function remove($productId) {
        if (array_key_exists($productId, $this->items)) {
            unset($this->items[$productId]);
            session(['cart' => $this->items]);
            // Nếu bạn muốn sử dụng Eloquent để xóa sản phẩm khỏi cơ sở dữ liệu, bạn có thể sử dụng đoạn mã sau:
            // Cart::where('productId', $productId)->delete();
        }
    }
    public function isEmpty() {
        return empty($this->items);
    }

    public function isPaid()
    {
        // Kiểm tra trạng thái thanh toán của giỏ hàng từ Session
        return Session::get('cart_paid', false);
    }


    // public function create($data)
    // {
    //     return CartModel::create($data);
    // }

    // public function add($product, $quantity = 1){
    //     $item = [
    //     'productId' => $product->id,
    //     'name' => $product->name,
    //     'price' =>$product -> sale_price > 0 ? $product -> sale_price : $product->price,
    //     'image' => $product ->image,
    //     'quantity'=> $quantity
        
    //     ] ;
    //     $this->items[$product->id]=$item;
    //     session(['cart'=>$this->items]);
    //     // Cart::create($item);
    // }
   
    // public function add($id){
    //     $prod = Product::findOrFail($id);
    //     $cart = session()->get('cart',[]);
    //     if(isset($cart[$id])){
    //         $cart[$id]['quantity']++;

    //     } else{
    //         $cart[$id]= [
    //             'name' => $product->name,
    //             'price' =>$product -> sale_price > 0 ? $product -> sale_price : $product->price,
    //             'image' => $product ->image,
    //             'quantity'=> $quantity
    //         ]   ;
    //     }
    //     session()->put('cart', $cart);
    //     return redirect()->back()->with('success','Sản phẩm đã được thêm vào giỏ hàng');
    // }

    //Cap nhat gio hang


    //xoa san pham trong gio hang


    //xoa tat ca san pham gio hang

    //tinh tong tien các sp

    public function gettotalPrice()
    {
        $totalPrice =0;
        foreach ($this->items as $item)
        {
            $totalPrice += $item['price']* $item['quantity'];
        }
        return $totalPrice;
    }
    public function gettotalQuantity(){
        $totalQuantity =0;
        foreach ($this->items as $item){
            $totalQuantity += $item['quantity'];
        }
        return $totalQuantity;
    }
    
}