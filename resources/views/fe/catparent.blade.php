@extends('fe.master')
@section('title','Sản phẩm của danh mục')
@section('main-content')
<link rel="stylesheet" href="{{asset('assets')}}/styles.css">
<h1 style="display: inline;">Danh mục:</h1> 
<h2 style="display: inline; margin-left: 10px;">{{$cat->name}}</h2>

    
    <div class="product-container">
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
                        <p class="product-price">Giá: {{ number_format($prod->sale_price) }}đ    <p><span class="product-discount">Giá gốc: {{ number_format($prod->price) }}đ</span></p>
                    @else
                        <p class="product-price">{{ number_format($prod->price) }}đ</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection