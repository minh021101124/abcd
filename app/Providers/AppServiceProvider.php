<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Avatar;
use App\Models\Invoice;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot():void
    {
        Paginator::useBootstrap();

        view()->composer([
        'fe.home',
        'fe.catdetail',
        'fe.detail',
        'fe.search-results','fe.cart',
        'fe.empty','fe.checkout','fe.demo',
        'fe.checkout_infor'],function($view) {
            $categories = Category::with('children')->whereNull('parent_id')->orderBy('name', 'ASC')->get();
            $view->with(compact('categories'));
        });
        view()->composer([ 'fe.home',
        'fe.catdetail',
        'fe.detail',
        'fe.search-results','fe.cart',
        'fe.empty','fe.checkout','fe.demo',
        'fe.checkout_infor'], function ($view) {
            $img = Banner::all();
            $view->with(compact('img'));
        });
        view()->composer([ 'fe.home',
        'fe.catdetail',
        'fe.detail',
        'fe.search-results','fe.cart',
        'fe.empty','fe.checkout','fe.demo',
        'fe.checkout_infor'], function ($view) {
            $im = Avatar::orderBy('id', 'DESC')->limit(1)->get();
            $view->with(compact('im'));
        });
      
        
        // view()->composer(['fe.home', 'fe.catdetail', 'fe.detail', 'fe.search-results', 'fe.cart', 'fe.empty', 'fe.checkout', 'fe.demo', 'fe.checkout_infor'], function ($view) {
           
        //     $price = Product::where('id', 6)->value('price');


        //     // $saleprice = Product::select( 'sale_price')->get();
            
        
           
        
           
          
           
        //     $view->with('price', $price);
        // });
    }
}
