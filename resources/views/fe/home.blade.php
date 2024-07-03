@extends('fe.master')
@section('main-content')
@section('title','Trang chủ')
{{-- <div class="banner">
    @foreach ($img as $item)
    <img src="{{ asset('imagebanner/' . $item->cover) }}"   width="880px" height="240px">
    @endforeach
</div> --}}
<style>
    .quangcao{
        width: 30%;
        background: #ffffff;
       
    }
    .quangcao img{
        width: 100%;
       height: 110px;
    }
    #img2{
        margin-top: 30px;
    }
</style>
<div class="banner" >
    <div class="cont" style="padding: 0px;display:flex;gap:20px">
        <div class="slider">
            <div class="slides">
                @foreach ($img as $item)
                <img src="{{ asset('imagebanner/' . $item->cover) }}" class="slide active" style="width:200px;height:260px">
                @endforeach
                <!-- Thêm ảnh khác ở đây -->
            </div>
            <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
            <button class="next" onclick="changeSlide(1)">&#10095;</button>
        </div>
        <div class="quangcao">
            <a href="{{route('tuvan')}}"><img src="https://cdn.tgdd.vn/2023/10/banner/Banner-390x145-1.png"></a>
            
            <img src="https://cdn.tgdd.vn/2024/05/banner/OLOL-Desk--1--390x145.png" id="img2">
        </div>
    </div>
</div>

<script src="script.js"></script>
<div style="background: #fcf3e8;margin-top:30px">
    
    
    <img src="{{asset('assets')}}/images/banchay.png" class="img-circle"  width="250px" height="40px" style="margin-left:40% ;margin-top:-10px">
        
</div>
<div class="product-container">
    @foreach ($prod as $item)
        <div class="product-item">
            {{-- @foreach($price as $discountPercentage)
            <span class="discount-percent">{{ $discountPercentage }}</span>
            @endforeach --}}
        
        
            {{-- {{$cart->gettotalQuantity()}} --}}
            <div class="img-product">
                <a href="{{ route('detail', $item->slug) }}"> 
                    <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}" class="product-image" height="200px">

                </a>
            </div>
            <div class="product-details">
                <div class="titlen"> 
                    <a href="{{ route('detail', $item->slug) }}">
                        <h2 class="product-title">{{ $item->name }}</h2>
                    </a>
                </div>
               
              
                {{-- <p class="product-category"><span class="category-dm">Danh mục: </span> <a href="{{ route('fe.catdetail', $item->category->id) }}">{{ $item->category->name }}</a> </p> --}}
              <div class="pricen">
                @if ($item->sale_price)
                    <p class="product-price">{{ number_format($item->sale_price) }}đ    <p><span class="product-discount">{{ number_format($item->price) }}đ</span></p>
                @else
                    <p class="product-price">{{ number_format($item->price) }}đ</p>
                @endif
              </div>
                <form action="{{ route('cart.add') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">
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


{{-- @foreach ($categories as $category)
    @php
        $hasProducts = false;
    @endphp
    <div class="product-container">
        @foreach ($category->children as $childCategory)
            @if ($childCategory->products->isNotEmpty())
                @php
                    $hasProducts = true;
                @endphp
                <div class="child-category">
                    <h3>{{ $childCategory->name }}</h3>
                    <div class="child-category-products">
                        @foreach ($childCategory->products as $product)
                            <div class="product-item">
                                <div class="img-product">
                                    <a href="{{ route('detail', $product->slug) }}"> 
                                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="product-image" height="200px">
                                    </a>
                                </div>
                                <div class="product-details">
                                    <h2 class="product-title">{{ $product->name }}</h2>
                                    <p class="product-price">
                                        @if ($product->sale_price)
                                            Giá: {{ number_format($product->sale_price) }}đ <br>
                                            <span class="product-discount">Giá gốc: {{ number_format($product->price) }}đ</span>
                                        @else
                                            Giá: {{ number_format($product->price) }}đ
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endforeach --}}

@foreach ($categories as $category)
    @php
        $hasProducts = false;
        
    @endphp
    <div class="product-container" style="background: rgb(255, 255, 255);">
       
                @foreach ($category->children as $childCategory)
                    @if ($childCategory->products->isNotEmpty())
                        @php
                            $hasProducts = true;
                        @endphp
                       
                                <div class="child-category">
                                    <div class="titl" style="border:solid 1px rgb(4, 113, 246);padding-left:20px;background:#1b87ec">
                                        <h2 style="color: rgb(255, 255, 255);text-align:center">{{ $childCategory->name }}</h2>
                                    </div>
                                   
                                    <div class="child-category-products" style="background: #eeeeee;">
                                        @foreach ($childCategory->products as $item)
                                        <div class="product-item">
                                            <div class="img-product">
                                                <a href="{{ route('detail', $item->slug) }}"> 
                                                    <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}" class="product-image" height="200px">
                                
                                                </a>
                                            </div>
                                            <div class="product-details">
                                                <div class="titlen"> 
                                                    <a href="{{ route('detail', $item->slug) }}">
                                                        <h2 class="product-title">{{ $item->name }}</h2>
                                                    </a>
                                                </div>
                                            
                                            
                                                {{-- <p class="product-category"><span class="category-dm">Danh mục: </span> <a href="{{ route('fe.catdetail', $item->category->id) }}">{{ $item->category->name }}</a> </p> --}}
                                            <div class="pricen">
                                                @if ($item->sale_price)
                                                    <p class="product-price">{{ number_format($item->sale_price) }}đ    <p><span class="product-discount">{{ number_format($item->price) }}đ</span></p>
                                                @else
                                                    <p class="product-price">{{ number_format($item->price) }}đ</p>
                                                @endif
                                            </div>
                                                <form action="{{ route('cart.add') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
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
                                </div>
                         
                    @endif
                @endforeach
        
    </div>
@endforeach


<style>
 .bao{
    height: 100%;background: #fcf3e8
 }
</style>
<script>
    let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const intervalTime = 3800; // time chuyen hinh moi (mili giay)
let slideInterval;

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.remove('active');
        if (i === index) {
            slide.classList.add('active');
        }
    });
}

function changeSlide(direction) {
    currentSlide += direction;
    if (currentSlide < 0) {
        currentSlide = slides.length - 1;
    } else if (currentSlide >= slides.length) {
        currentSlide = 0;
    }
    showSlide(currentSlide);
}

function startSlideShow() {
    slideInterval = setInterval(() => {
        changeSlide(1);
    }, intervalTime);
}

function stopSlideShow() {
    clearInterval(slideInterval);
}

window.onload = function() {
    showSlide(currentSlide);
    startSlideShow();
};


document.querySelector('.prev').addEventListener('click', () => {
    stopSlideShow();
    changeSlide(-1);
    startSlideShow();
});

document.querySelector('.next').addEventListener('click', () => {
    stopSlideShow();
    changeSlide(1);
    startSlideShow();
});

    </script>
@endsection

