<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\AvatarController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeControllerr;



use Dompdf\Dompdf;
use Dompdf\Options;

use App\Http\Controllers\PostController;

use App\Http\Controllers\ModalController;
use Illuminate\Support\Facades\Route;




Route::get('/', [HomeController::class,'index'])->name('index');
Route::get('detail/{slug}', [HomeController::class, 'detail'])->name('detail');
Route::get('category-product/{cat}', [HomeController::class, 'category'])->name('fe.catdetail');

Route::post('/add-cart',[CartController::class,'add'])->name('cart.add');
Route::get('/cart',[CartController::class,'index'])->name('cart.index');





Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.index');
    Route::get('/statistic', [DashboardController::class, 'statistic'])->name('admin.statistic');
 
    Route::resource('category', CategoryController::class);
    
    Route::get('/category-trash',[CategoryController::class,'trash'])->name('category.trash');
    Route::get('/category/{id}/restore',[CategoryController::class,'restore'])->name('category.restore');
    Route::get('/category/{id}/forceDelete',[CategoryController::class,'forceDelete'])->name('category.forceDelete');

    Route::resource('product', ProductController::class);

    Route::get('/product-trash',[ProductController::class,'trash'])->name('product.trash');
    Route::get('/product/{id}/restore',[ProductController::class,'restore'])->name('product.restore');
    Route::get('/product/{id}/forceDelete',[ProductController::class,'forceDelete'])->name('product.forceDelete');
    Route::put('/update/{id}',[ProductController::class,'update']);
    Route::delete('/deleteimagepro/{id}', [ProductController::class, 'deleteimagepro'])->name('deleteimagepro');
    
    Route::get('/product/{productId}', 'ProductController@show')->name('product.detail');

    Route::resource('banner', BannerController::class);
    //Route::get('/banner', [BannerController::class, 'add'])->name('admin.banner');
    Route::delete('/deleteimage/{id}', [BannerController::class, 'deleteimage'])->name('deleteimage');
    Route::resource('avatar', AvatarController::class);
    Route::delete('/deleteimageavt/{id}', [AvatarController::class, 'deleteimageavt'])->name('deleteimageavt');




});

Route::get('/search', [ProductController::class,'search'])->name('search');
Route::get('/empty', [HomeController::class,'empty'])->name('empty');
Route::get('/tuvan', [HomeController::class,'tuvan'])->name('tuvan');
// Route::get('/prod/{id}', [CartController::class,'addCart'])->name('addprodtocart');
Route::post('/remove-from-cart', [CartController::class,'removeFromCart'])->name('cart.remove');
Route::post('/update-cart-quantity', [CartController::class, 'updateCartQuantity'])->name('cart.updateQuantity');
Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');
Route::get('/Checkout_infor', [CheckoutController::class, 'showCheckout_infor'])->name('checkout_infor');
// Route::post('/Checkout_infor', [CheckoutController::class, 'showCheckout_infor'])->name('checkout_infor');
Route::post('/checkout_infor/store', [CheckoutController::class, 'store'])->name('checkout_infor.store');

Route::get('/demo', [HomeController::class, 'demo'])->name('demo');


Route::post('/vnpay_payment',[PaymentController::class,'vnpay_payment']);

// Route::post('/checkout', 'CheckoutController@processCheckout')->middleware('auth');





// Route::get('/a',[PostController::class,'index']);

// Route::get('/create',function(){
// return view('admin.prod.create');
// });

// Route::post('/post',[PostController::class,'store']);
// Route::delete('/delete/{id}',[PostController::class,'destroy']);
// Route::get('/edit/{id}',[PostController::class,'edit']);

// Route::delete('/deleteimage/{id}',[PostController::class,'deleteimage']);
// Route::delete('/deletecover/{id}',[PostController::class,'deletecover']);

// Route::put('/update/{id}',[PostController::class,'update']);

// Route::group(['middleware' => 'guest'], function () {
//     Route::get('/register', [AuthController::class, 'register'])->name('register');
//     Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
//     Route::get('/login', [AuthController::class, 'login'])->name('login');
//     Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
// });
// Route::get('/home', [HomeController::class, 'index']);
// Route::group(['middleware' => 'auth'], function () {
//     Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
// });

Route::group(['middleware' => 'guest'], function () {
   
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
   

});
// Route::get('/home', [HomeController::class, 'index']);
// Route::get('/', [DashboardController::class, 'index'])->name('admin.index');
Route::group(['middleware' => 'auth'], function () {
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/change', [AuthController::class, 'change'])->name('change');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change-password');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
});
Route::get('/export-invoice', [ProductController::class, 'exportInvoice'])->name('export.invoice');

// Route::get('/register', [AuthController::class, 'register'])->name('register');
//     Route::post('/register', [AuthController::class, 'registerPost'])->name('register');



//Route::get('/admin', 'DashboardController@index')->middleware('admin.auth')->name('admin.index');
// Route::get('/admin', [DashboardController::class, 'index'])->middleware('admin.auth')->name('admin.index');