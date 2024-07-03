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



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index',compact('products'));
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
    // public function store(Request $request)
    // {

    //      // Định nghĩa các quy tắc validation
    //      $rules = [
    //         'name' => 'required',
    //         'price' => 'required|numeric',
    //         'photo' => 'required|image',
    //         // Thêm các quy tắc cho các trường khác nếu cần
    //     ];

    //     // Định nghĩa các thông báo lỗi tùy chỉnh
    //     $messages = [
    //         'name.required' => 'Vui lòng nhập tên sản phẩm.',
    //         'price.required' => 'Vui lòng nhập giá sản phẩm.',
    //         'price.numeric' => 'Giá sản phẩm phải là một số.',
    //         'photo.required' => 'Vui lòng chọn ảnh sản phẩm.',
    //         'photo.image' => 'Tệp phải là hình ảnh.',
    //         // Thêm các thông báo lỗi cho các trường khác nếu cần
    //     ];

    //     // Tạo validator và kiểm tra dữ liệu
    //     $validator = Validator::make($request->all(), $rules, $messages);

    //     // Kiểm tra nếu dữ liệu không hợp lệ
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     // Tiếp tục xử lý tạo sản phẩm nếu dữ liệu hợp lệ

    //     // Code tạo sản phẩm và xử lý ảnh sản phẩm ở đây...


    //     //upload files
        
    //     $fileName = $request-> photo->getClientOriginalName();
    //     $request->photo->storeAs('public/images',$fileName);
    //     $request->merge(['image'=>$fileName]);
    //     try {
    //        $product = Product::create($request->all());

    //        if($product  &&  $request->hasFile('photos')){
    //         foreach ($request-> photos as $key => $value) {
    //             $fileNames = $value->getClientOriginalName();
    //             $value->storeAs('public/images',$fileNames);
    //             ImgProduct::create([
    //                 'product_id'=>$product->id,
    //                 'image'=>$fileNames
    //             ]);
    //         }
    //        }
    //        return redirect() ->route('product.index')->with('success','Thêm mới thành công');
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }
        
    //     $fileName = null;

    //     if($request->hasFile('photo')) {
    //         $fileName = $request->photo->getClientOriginalName();
    //         $request->photo->storeAs('public/images', $fileName);
    //     }
        
    //     try {
    //         $requestData = $request->all();
        
    //         // Thêm trường 'image' vào dữ liệu yêu cầu nếu có tên hình ảnh
    //         if ($fileName) {
    //             $requestData['image'] = $fileName;
    //         }
        
    //         // Tạo sản phẩm
    //         $product = Product::create($requestData);
        
    //         if ($product && $request->hasFile('photos')) {
    //             foreach ($request->photos as $key => $value) {
    //                 $fileNames = $value->getClientOriginalName();
    //                 $value->storeAs('public/images', $fileNames);
    //                 ImgProduct::create([
    //                     'product_id' => $product->id,
    //                     'image' => $fileNames
    //                 ]);
    //             }
    //         }
    //         return redirect()->route('product.index')->with('success', 'Thêm mới thành công');
    //     } catch (\Throwable $th) {
    //         // Xử lý ngoại lệ
    //     }
        

    //     //dd($request->all());
    // }
//     public function store(Request $request)
// {
//     try {
//         // Upload file ảnh chính nếu có
//         $fileName = null;
//         if ($request->hasFile('photo')) {
//             $fileName = $request->photo->getClientOriginalName();
//             $request->photo->storeAs('public/images', $fileName);
//         }

//         // Kiểm tra nếu giá sale có tồn tại trong request
//         $salePrice = $request->has('sale_price') ? $request->sale_price : null;

//         // Tạo sản phẩm
//         $productData = $request->except(['_token', 'photo', 'photos', 'sale_price']); // Loại bỏ các trường không cần thiết
//         $productData['image'] = $fileName; // Gán giá trị ảnh chính
//         $productData['sale_price'] = $salePrice; // Gán giá trị giá sale
//         $product = Product::create($productData);

//         // Nếu có ảnh phụ
//         if ($product && $request->hasFile('photos')) {
//             foreach ($request->photos as $photo) {
//                 $photoName = $photo->getClientOriginalName();
//                 $photo->storeAs('public/images', $photoName);
//                 ImgProduct::create([
//                     'product_id' => $product->id,
//                     'image' => $photoName
//                 ]);
//             }
//         }

//         return redirect()->route('product.index')->with('success', 'Thêm mới thành công');
//     } catch (\Throwable $th) {
//         // Xử lý ngoại lệ
//         return redirect()->back()->with('error', 'Đã xảy ra lỗi, vui lòng thử lại sau.')->withInput();
//     }
// }
// public function store(Request $request)
// {
//     try {
//         // Validate request
//         $request->validate([
//             'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ảnh chính là bắt buộc và phải là định dạng hình ảnh
//         ]);

//         // Upload file ảnh chính
//         $fileName = $request->photo->getClientOriginalName();
//         $request->photo->storeAs('public/images', $fileName);

//         // Kiểm tra nếu giá sale có tồn tại trong request
//         $salePrice = $request->has('sale_price') ? $request->sale_price : null;

//         // Tạo sản phẩm
//         $productData = $request->except(['_token', 'photo', 'photos', 'sale_price']); // Loại bỏ các trường không cần thiết
//         $productData['image'] = $fileName; // Gán giá trị ảnh chính
//         $productData['sale_price'] = $salePrice; // Gán giá trị giá sale
//         $product = Product::create($productData);

//         // Nếu có ảnh phụ
//         if ($product && $request->hasFile('photos')) {
//             foreach ($request->photos as $photo) {
//                 $photoName = $photo->getClientOriginalName();
//                 $photo->storeAs('public/images', $photoName);
//                 ImgProduct::create([
//                     'product_id' => $product->id,
//                     'image' => $photoName
//                 ]);
//             }
//         }

//         return redirect()->route('product.index')->with('success', 'Thêm mới thành công');
//     } catch (\Throwable $th) {
//         // Xử lý ngoại lệ
//         return redirect()->back()->with('error', 'Đã xảy ra lỗi, vui lòng thử lại sau.')->withInput();
//     }
// }  //mới


// public function store(StoreProductRequest $request)
// {
//     try {
//         // Validate request
//         $validatedData = $request->validated();

//         // Tiếp tục xử lý khi request hợp lệ
//         // Upload file ảnh chính
//         $fileName = null;
//         if ($request->hasFile('photo')) {
//             $fileName = $request->photo->getClientOriginalName();
//             $request->photo->storeAs('public/images', $fileName);
//         }

//         // Tạo sản phẩm
//         $productData = $request->except(['_token', 'photo', 'photos']); // Loại bỏ các trường không cần thiết
//         $productData['image'] = $fileName; // Gán giá trị ảnh chính

//         // Kiểm tra nếu giá sale có tồn tại và hợp lệ trong request
//         $salePrice = $request->input('sale_price', null);
//         if ($salePrice !== null) {
//             // Kiểm tra nếu giá khuyến mãi không hợp lệ
//             if ($salePrice >= $productData['price']) {
//                 return redirect()->back()->with('error', 'Giá khuyến mãi phải nhỏ hơn giá bán.')->withInput();
//             }
//             $productData['sale_price'] = $salePrice; // Gán giá trị giá sale
//         }

//         // Tạo sản phẩm trong cơ sở dữ liệu
//         $product = Product::create($productData);

//         // Xóa ID danh mục đã chọn từ Session sau khi sản phẩm được tạo thành công
//         $selectedCategoryId = $request->input('selected_category_id');

//         // Lưu ID danh mục đã chọn trước đó vào Session hoặc cookie
//         session(['selected_category_id' => $selectedCategoryId]);

//         // Nếu có ảnh phụ
//         if ($request->hasFile('photos')) {
//             foreach ($request->file('photos') as $photo) {
//                 $photoName = $photo->getClientOriginalName();
//                 $photo->storeAs('public/images', $photoName);
//                 ImgProduct::create([
//                     'product_id' => $product->id,
//                     'image' => $photoName
//                 ]);
//             }
//         }

//         return redirect()->route('product.index')->with('success', 'Thêm mới thành công');
//     } catch (\Throwable $th) {
//         // Xử lý ngoại lệ
//         return redirect()->back()->with('error', 'Đã xảy ra lỗi, vui lòng thử lại sau.')->withInput();
//     }
// }


// public function store(StoreProductRequest $request)
// {
//     try {
//         // Validate request
//         $validatedData = $request->validated();

//         // Tiếp tục xử lý khi request hợp lệ
//         // Upload file ảnh chính
//         $fileName = null;
//         if ($request->hasFile('photo')) {
//             $fileName = $request->photo->getClientOriginalName();
//             $request->photo->storeAs('public/images', $fileName);
//         }

//         // Tạo sản phẩm
//         $productData = $request->except(['_token', 'photo', 'photos']); // Loại bỏ các trường không cần thiết
//         $productData['image'] = $fileName; // Gán giá trị ảnh chính

//         // Kiểm tra nếu giá sale có tồn tại và hợp lệ trong request
//         $salePrice = $request->input('sale_price', null);
//         if ($salePrice !== null) {
//             // Kiểm tra nếu giá khuyến mãi không hợp lệ
//             if ($salePrice >= $productData['price']) {
//                 return redirect()->back()->with('error', 'Giá khuyến mãi phải nhỏ hơn giá bán.')->withInput();
//             }
//             $productData['sale_price'] = $salePrice; // Gán giá trị giá sale
//         }

//         // Tạo sản phẩm trong cơ sở dữ liệu
//         $product = Product::create($productData);

//         // Xóa ID danh mục đã chọn từ Session sau khi sản phẩm được tạo thành công
//         $selectedCategoryId = $request->input('selected_category_id');

//         // Lưu ID danh mục đã chọn trước đó vào Session hoặc cookie
//         session(['selected_category_id' => $selectedCategoryId]);

//         // Nếu có ảnh phụ
//         if ($request->hasFile('photos')) {
//             foreach ($request->file('photos') as $photo) {
//                 $photoName = $photo->getClientOriginalName();
//                 $photo->storeAs('public/images', $photoName);
//                 ImgProduct::create([
//                     'product_id' => $product->id,
//                     'image' => $photoName
//                 ]);
//             }
//         }
//         // Upload and save images
//     $imagePaths = [];
//     foreach ($request->file('images') as $image) {
//         $path = $image->store('product_images');
//         $imagePaths[] = $path;
//     }

//         return redirect()->route('product.index')->with('success', 'Thêm mới thành công');
//     } catch (\Throwable $th) {
//         // Xử lý ngoại lệ
//         return redirect()->back()->with('error', 'Đã xảy ra lỗi, vui lòng thử lại sau.')->withInput();
//     }
// }
public function store(StoreProductRequest $request)
{
    try {
        // Validate request
        $validatedData = $request->validated();

        // Tiếp tục xử lý khi request hợp lệ
        // Upload file ảnh chính
        $fileName = null;
        if ($request->hasFile('photo')) {
            $fileName = $request->photo->getClientOriginalName();
            $request->photo->storeAs('public/images', $fileName);
        }

        // Tạo sản phẩm
        $productData = $request->except(['_token', 'photo', 'photos']); // Loại bỏ các trường không cần thiết
        $productData['image'] = $fileName; // Gán giá trị ảnh chính

        // Kiểm tra nếu giá sale có tồn tại và hợp lệ trong request
        $salePrice = $request->input('sale_price', null);
        if ($salePrice !== null) {
            // Kiểm tra nếu giá khuyến mãi không hợp lệ
            if ($salePrice >= $productData['price']) {
                return redirect()->back()->with('error', 'Giá khuyến mãi phải nhỏ hơn giá bán.')->withInput();
            }
            $productData['sale_price'] = $salePrice; // Gán giá trị giá sale
        }

        // Tạo sản phẩm trong cơ sở dữ liệu
        $product = Product::create($productData);

        // Xóa ID danh mục đã chọn từ Session sau khi sản phẩm được tạo thành công
        $selectedCategoryId = $request->input('selected_category_id');

        // Lưu ID danh mục đã chọn trước đó vào Session hoặc cookie
        session(['selected_category_id' => $selectedCategoryId]);

        // Nếu có ảnh phụ
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoName = $photo->getClientOriginalName();
                $photo->storeAs('public/images', $photoName);
                ImgProduct::create([
                    'product_id' => $product->id,
                    'image' => $photoName
                ]);
            }
        }

        return redirect()->route('product.index')->with('success', 'Thêm mới thành công');
    } catch (\Throwable $th) {
        // Xử lý ngoại lệ
        return redirect()->back()->with('error', 'Đã xảy ra lỗi, vui lòng thử lại sau.')->withInput();
    }
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
       
        $categories = Category::orderBy('name','ASC')->get();
        return view('admin.product.edit',compact('product','products','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(UpdateProductRequest $request, Product $product)
    // {
    //     try {
    //         // Kiểm tra nếu có ảnh sản phẩm mới được tải lên
    //         if ($request->hasFile('photo')) {
    //             // Lưu ảnh mới vào thư mục
    //             $fileName = $request->photo->getClientOriginalName();
    //             $request->photo->storeAs('public/images', $fileName);
    //             // Cập nhật đường dẫn ảnh mới vào cơ sở dữ liệu
    //             $product->update([
    //                 'image' => $fileName
    //             ]);
    //         }
    
    //         // Kiểm tra nếu có ảnh mô tả mới được tải lên
    //         if ($request->hasFile('photos')) {
    //             // Xử lý và lưu ảnh mô tả mới vào thư mục
    //             foreach ($request->file('photos') as $photo) {
    //                 $fileName = $photo->getClientOriginalName();
    //                 $photo->storeAs('public/images', $fileName);
    //                 // Thêm ảnh mô tả mới vào cơ sở dữ liệu
    //                 $product->images()->create(['image' => $fileName]);
    //             }
    //         }
           
            
            
            

    
    //         // Cập nhật các trường dữ liệu khác của sản phẩm
    //         $product->update($request->except(['_token', 'photo', 'photos', 'removed_photos']));
    
    //         return redirect()->route('product.index')->with('success', 'Cập nhật thành công');
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', 'Cập nhật thất bại: ' . $th->getMessage());
    //     }
    // }
    
   

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            // Kiểm tra nếu có ảnh sản phẩm mới được tải lên
            if ($request->hasFile('photo')) {
                // Xóa ảnh cũ nếu có
                if ($product->image) {
                    Storage::delete('public/images/' . $product->image);
                }
    
                // Lưu ảnh mới vào thư mục
                $fileName = $request->photo->getClientOriginalName();
                $request->photo->storeAs('public/images', $fileName);
                // Cập nhật đường dẫn ảnh mới vào cơ sở dữ liệu
                $product->update([
                    'image' => $fileName
                ]);
            }
    
            // Kiểm tra nếu có ảnh mô tả mới được tải lên
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $fileName = $photo->getClientOriginalName();
                    $photo->storeAs('public/images', $fileName);
                    // Thêm ảnh mô tả mới vào cơ sở dữ liệu
                    $product->images()->create(['image' => $fileName]);
                }
            }
    
            // Kiểm tra nếu có các ảnh đã được đánh dấu để xóa
            if ($request->has('deleted_image_ids')) {
                $deletedImageIds = $request->deleted_image_ids;
                // Xóa các ảnh có ID nằm trong danh sách $deletedImageIds khỏi cơ sở dữ liệu
                ImgProduct::whereIn('id', $deletedImageIds)->delete();
                // Đồng thời cũng cần xóa các ảnh khỏi thư mục lưu trữ
                foreach ($deletedImageIds as $imageId) {
                    $image = ImgProduct::find($imageId);
                    if ($image) {
                        Storage::delete('public/images/' . $image->image);
                    }
                }
            }
    
            // Cập nhật trường parent_id cho sản phẩm
            $product->update([
                'parent_id' => $request->parent_id, // Đảm bảo rằng trường parent_id tồn tại trong bảng products
            ]);
    
            // Cập nhật các trường dữ liệu khác của sản phẩm
            $product->update($request->except(['_token', 'photo', 'photos', 'removed_photos', 'parent_id']));
    
            return redirect()->route('product.index')->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Cập nhật thất bại: ' . $th->getMessage());
        }
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
        Product::withTrashed()->where('id',$id)->forceDelete();
       
        return redirect() ->route('product.trash')->with('success','Thành công');
    }

    public function search(Request $request, Cart $cart)
{
    $query = $request->input('query');
    
    // Kiểm tra xem trường thông tin tìm kiếm có được nhập không
    if ($query) {
        $products = Product::where('name', 'LIKE', "%$query%")->get();
    } else {
        // Nếu trường thông tin tìm kiếm trống, trả về trang trắng
        return redirect()->route('empty');
    }

    return view('fe.search-results', compact('products', 'cart'));
}

// public function deleteImage($id)
//     {
//         // Tìm ảnh theo ID
//         $image = ImgProduct::findOrFail($id);
        
//        if(File::exists("storage/images/".$images->image)){
//         File::delete("storage/images/".$images->image);
//        }
//        ImgProduct::find($id)->delete();
//         return back();
        
//     }
        public function deleteimage($id){
            $images=ImgProduct::findOrFail($id);
            if (File::exists("storage/images/".$images->image)) {
            File::delete("storage/images/".$images->image);
        }

        Image::find($id)->delete();
        return back();
        }
    
       

}
