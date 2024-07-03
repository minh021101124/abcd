@extends('fe.master')
@section('title','Sản phẩm của danh mục')
@section('main-content')
<link rel="stylesheet" href="{{asset('assets')}}/styles.css">
<h1 style="display: inline;">Danh mục:</h1> 
<h2 style="display: inline; margin-left: 10px;">{{$cat->name}}</h2>
<div class="product-container">
    @foreach ($products as $prod)
        <div class="product-item">
            {{-- @foreach($price as $discountPercentage)
            <span class="discount-percent">{{ $discountPercentage }}</span>
            @endforeach --}}
        
        
            {{-- {{$cart->gettotalQuantity()}} --}}
            <div class="img-product">
                <a href="{{ route('detail', $prod->slug) }}"> 
                    <img src="{{ asset('images/' . $prod->image) }}" alt="{{ $prod->name }}" class="product-image" height="200px">

                </a>
            </div>
            <div class="product-details">
                <div class="titlen"> 
                    <a href="{{ route('detail', $prod->slug) }}">
                        <h2 class="product-title">{{ $prod->name }}</h2>
                    </a>
                </div>
               
              
                {{-- <p class="product-category"><span class="category-dm">Danh mục: </span> <a href="{{ route('fe.catdetail', $item->category->id) }}">{{ $item->category->name }}</a> </p> --}}
              <div class="pricen">
                @if ($prod->sale_price)
                    <p class="product-price">{{ number_format($prod->sale_price) }}đ    <p><span class="product-discount">{{ number_format($prod->price) }}đ</span></p>
                @else
                    <p class="product-price">{{ number_format($prod->price) }}đ</p>
                @endif
              </div>
                <form action="{{ route('cart.add') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $prod->id }}">
                    <td colspan="2">
                        <div class="quantity">
                            <input type="number" class="quantity-input" name="quantity" value="1">
                        </div>
                    </td>
                    <td colspan="2"><button type="submit" class="addto">Chọn mua</button></td>
    
                </form>
            </div>
        </div>
    @endforeach
</div>
    
    {{-- <div class="product-container">
        @foreach ($products as $prod)
            <div class="product-item">
                <div class="img-product">
                    <a href="{{ route('detail', $prod->slug) }}"> 
                        <img src="{{ asset('images/' . $prod->image) }}" alt="{{ $prod->name }}" class="product-image" height="200px">
                    </a>
                </div>
                <div class="product-details">
                    <h2 class="product-title">{{ $prod->name }}</h2>
                    <p class="product-category"><span class="category-dm">Danh mục: </span> <a href="{{ route('fe.catdetail', $prod->category->id) }}">{{ $prod->category->name }}</a> </p>
                    @if ($prod->sale_price)
                        <p class="product-price">{{ number_format($prod->sale_price) }}đ    <p><span class="product-discount">{{ number_format($prod->price) }}đ</span></p>
                    @else
                        <p class="product-price">{{ number_format($prod->price) }}đ</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div> --}}
@endsection