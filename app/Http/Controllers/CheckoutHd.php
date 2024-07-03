<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Cart;


use App\Models\Product;
class CheckoutHd extends Controller
{
    public function index(Cart $cart){
        return view('fe.checkout_infor', compact('cart'));
    }
}
