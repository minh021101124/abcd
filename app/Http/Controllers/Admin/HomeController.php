<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Cart;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Cart $cart){
        $cats = Category::orderBy('name' , 'ASC')->get();
        $prod = Product::orderBy('id', 'DESC')->limit(12)->get();
        $img = Banner::all();

        
        return view ('fe.home',compact('cats','prod','cart','img'));
    }

    // public function detail($slug,Cart $cart){
    //     $product = Product::where('slug',$slug)->first();

    //     $related =Product::where('category_id',$product->category_id)->where('id','!=',$product->id)->get();
    //     return view ('fe.detail',compact('product','related','cart'));
    // }
    public function detail($slug, Cart $cart) {
        $product = Product::where('slug', $slug)->first();
        if ($product) {    
            $related = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->get();
            return view('fe.detail', compact('product', 'related', 'cart'));
        } 
        else 
        {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
        }
    }
    
    // public function category(Category $cat,Cart $cart){
    //     // $products = Product::where('category_id',$cat->id)->get();

    //    $products = $cat->products()->paginate(9);
    //     return view ('fe.catdetail',compact('cat','products','cart'));
    // }

    // public function category(Category $cat, Cart $cart) {
    //     $categories = $cat->allChildrenCategories()->pluck('id')->push($cat->id);
    //     $products = Product::whereIn('category_id', $categories)->paginate(9);
    //     return view('fe.catdetail', compact('cat', 'products', 'cart'));
    // }



    public function category(Category $cat, Cart $cart)
    {
        $categoryIds = $this->getAllCategoryIds($cat);
        $products = Product::whereIn('category_id', $categoryIds)->paginate(9);
        return view('fe.catdetail', compact('cat', 'products', 'cart'));
    }

    private function getAllCategoryIds(Category $category)
    {
        $ids = collect([$category->id]);
        $children = $category->allChildrenCategories()->get();

        foreach ($children as $child) {
            $ids = $ids->merge($this->getAllCategoryIds($child));
        }

        return $ids;
    }
    
    public function empty(Cart $cart){
        return view ('fe.empty',compact('cart'));
    }
    public function demo(Cart $cart){
        return view ('fe.demo',compact('cart'));
    }
    public function catego($slug){
        return view ('fe.master');
    }
    public function tuvan(){
        return view ('fe.tuvan');
    }

    public function percent() {
        // Lấy tất cả các sản phẩm từ bảng Product
        $products = Product::all();
    
        // Tạo một mảng để lưu trữ phần trăm giảm giá của từng sản phẩm
        $discountPercentages = [];
    
        // Lặp qua từng sản phẩm để tính phần trăm giảm giá
        foreach ($products as $product) {
            // Tính phần trăm giảm giá cho từng sản phẩm
            $discountPercentage = ($product->price - $product->sale_price) / $product->price * 100;
    
            // Thêm phần trăm giảm giá vào mảng
            $discountPercentages[] = $discountPercentage;
        }
    
        // Trả về view và truyền biến $discountPercentages
        return view('fe.home', compact('discountPercentages'));
    }
    
}
