<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Helper\Cart;
use App\Models\ImgProduct;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\File;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Infor;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::all();
        $posts = Product::orderBy('id', 'DESC')->get();
        // return view('admin.product.index',compact('products'));
        return view('admin.product.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $categories = Category::orderBy('name','ASC')->get();
        
    //     return view('admin.product.add',compact('categories'));
    // }
    public function create()
    {
        // Lấy ID của danh mục đã chọn trước đó từ Session
        $selectedCategoryId = session('selected_category_id') ?? request()->input('selected_category_id');
        
        // Lấy danh sách các danh mục
        $categories = Category::orderBy('name', 'ASC')->get();
    
        return view('admin.product.add', compact('categories', 'selectedCategoryId'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 

public function store(StoreProductRequest $request)
{
   
    $validatedData = $request->validated();
    if ($request->input('sale_price') > $request->input('price')) {
        $validatedData['sale_price'] = null;
    }
    $post = new Product();
    if($request->hasFile("photo")){
        $file = $request->file("photo");
        $imageName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path("images/"), $imageName);
        $slug = Str::slug($request->name);
        $post->name = $request->name;
        $post->price = $request->price;
        $post->slug = $slug;
        $post->sale_price = $request->sale_price;
        $post->category_id = $request->category_id;
        $post->description = $request->description;
        $post->short_description = $request->short_description;
        $post->image = $imageName;
        $post->save();
    }
    if($request->hasFile("photos")){
        $files = $request->file("photos");
        foreach($files as $file){
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path("images_many/"), $imageName);
            ImgProduct::create([
                "product_id" => $post->id, 
                "image" => $imageName,
            ]);
        }
    }
    return redirect()->route('product.index')->with('success', 'Thêm mới thành công');
}

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    public function edit(Product $product)
{
    $products = Product::all();
    $posts = Product::findOrFail($product->id); 
    $categories = Category::orderBy('name','ASC')->get();
    return view('admin.product.edit', compact('product', 'products', 'categories', 'posts'));
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
     public function update(Request $request, $id)
     {
         $product = Product::findOrFail($id);
     
    
         if ($request->hasFile("photo")) {
             $image = $request->file("photo");
             $imageName = 'product_' . $product->id . '.' . $image->getClientOriginalExtension();
     
             
             if (File::exists(public_path("images/" . $product->image))) {
                 File::delete(public_path("images/" . $product->image));
             }
     
         
             $image->move(public_path("images/"), $imageName);
             $product->image = $imageName;
         }
     
      
         $product->name = $request->name;
         $product->slug = $request->slug;
         $product->price = $request->price;
         $product->sale_price = $request->sale_price;
         $product->category_id = $request->category_id;
         $product->description = $request->description;
         $product->short_description = $request->short_description;
         $product->save();
     
         // Handle multiple image uploads
         if ($request->hasFile("photos")) {
             foreach ($request->file("photos") as $file) {
                 $randomString = uniqid();
                 $imageName = 'product_' . $product->id . '_' . $randomString . '.' . $file->getClientOriginalExtension();
                 
                 // Move image to the public directory
                 $file->move(public_path("images_many/"), $imageName);
                 ImgProduct::create([
                     "product_id" => $id,
                     "image" => $imageName,
                 ]);
             }
         }
     
         return redirect()->route('product.index')->with('success', 'Cập nhật thành công');
     }
     
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try{
            $product->delete();
            return redirect() ->route('product.index')->with('success','Xóa thành công');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error','Thất bại');
        }
    }
    public function trash() {
        $products = Product::onlyTrashed()->get();
        return view('admin.product.trash',compact('products'));
    }
    public function restore($id){
        Product::withTrashed()->where('id',$id)->restore();
        return redirect() ->route('product.index')->with('success','Khôi phục thành công');
    }
    public function forceDelete($id){
        // Xóa tất cả các bản ghi có product_id tương ứng trong bảng img_products
        ImgProduct::where('product_id', $id)->delete();
    
        // Tiến hành xóa vĩnh viễn bản ghi Product với id tương ứng
        Product::withTrashed()->where('id', $id)->forceDelete();
    
        // Redirect về route 'product.trash' với thông báo thành công
        return redirect()->route('product.trash')->with('success', 'Xóa vĩnh viễn thành công');
    }
    

    public function search(Request $request, Cart $cart)
{
    $query = $request->input('query');
    
   
    if ($query) {
        $products = Product::where('name', 'LIKE', "%$query%")->get();
    } else {
       
        return redirect()->route('empty');
    }

    return view('fe.search-results', compact('products', 'cart'));
}
    public function deleteimagepro($id){
        $image = ImgProduct::findOrFail($id);
    
        
        if (File::exists("images_many/" . $image->image)) {
            File::delete("images_many/" . $image->image);
        }
    
        
        $image->delete();
    
        return back()->with('success', 'Ảnh đã được xóa thành công');
    }
    
    public function forceDeleteSelected(Request $request)
{
    // Lấy danh sách các ID của các mục đã chọn từ request
    $selectedIds = $request->input('product_ids', []);

    // Xóa các mục đã chọn vĩnh viễn
    Product::whereIn('id', $selectedIds)->forceDelete();

    // Redirect về trang danh sách sản phẩm hoặc trang nào đó khác
    return redirect()->route('products.index')->with('success', 'Đã xóa các mục đã chọn vĩnh viễn.');
}
public function exportInvoice(Request $request)
{
    $infor = Infor::latest()->first();

   $prod= Product::first();
   

    $address = $request->input('address');
    $email = $request->input('email');
    $phone = $request->input('phone');
    
    $productName = session('product_name');
    $productPrice = session('product_price');
    $totalAmount = session('total_amount');

    
    $product = Product::first();

    
    $data = [
        'invoice_number' => 'HD'.mt_rand(1000, 9999),
        'customer_name' => $infor->name,
        'address' => $infor->address,
        'phone' => $infor->phone,
        'email' => $infor->email,
        'prod_name' => $product->product_name,
        'pc' => $product->price,
        'total_amount' => '$100.00', 
        
    ];

    // Khởi tạo Dompdf và cấu hình
    $dompdf = new Dompdf();
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf->setOptions($options);
    $html = view('invoice', $data);
    $dompdf->loadHtml($html);
    $dompdf->render();

    // Xuất hóa đơn PDF
    return $dompdf->stream('Hoa_don_ban_hang.pdf')->back();
}


}
