@extends('fe.master')
@section('main-content')
<link rel="stylesheet" href="{{asset('assets')}}/cssDetail.css">
<head><style>
    .product-name {
        word-wrap: break-word; /* Ngắt dòng cho từng từ */
    }
    .quantity {
    position: relative;
}

.quantity-input {
    width: 50px;
    text-align: center;
}

.quantity-btn {
    width: 25px;
    height: 25px;
    line-height: 25px;
    text-align: center;
    cursor: pointer;
    border: none;
    background-color: #f9f9f9;
    font-size: 16px;
    color: #333;
}

.quantity-btn:hover {
    background-color: #e0e0e0;
}

</style>
 </head>
 <div class="product-details">
    <img class="product-main-image" src="{{asset('storage/images')}}/{{$product->image}}" alt="Product Image 1">
    <div class="product-info">
        <span> {{session('success')}}</span>
        <table class="my-table">
            <tr>
                <td colspan="2"><h1 class="product-name">{{$product->name}}</h1></td>
            </tr>
            <tr>
                @if ($product->sale_price)
                    <td style="width: 100px;"><span class="product-price-detail">Giá sale:</span></td>
                    <td><span class="product-price-detail-number">{{ number_format($product->sale_price) }}đ</span></td>
                @else
                    <td colspan="2"><p class="product-price">{{ number_format($product->price) }}đ</p></td>
                @endif
            </tr>
            <tr>
                <td style="width: 100px;"><span class="product-discount-detail">Giá gốc:</span></td>
                <td><span class="product-discount-detail-number">{{ number_format($product->price) }}đ</span></td>
            </tr>
            <form action="{{ route('cart.add') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                 
                <td colspan="2">
                    <div class="quantity">
                        <input type="number" class="quantity-input" name="quantity" value="1">
                    </div>
                </td>
                
                <td colspan="2"><button type="submit">Thêm vào giỏ hàng</button></td>

            </form>
            
        </table>
    </div>
</div>

   
    <div class="product-thumbnails">
        <div class="product-thumbnail">
            <img src="{{asset('storage/images')}}/{{$product->image}}" alt="">
        </div>
        @foreach ($product-> images as $item)
        <div class="product-thumbnail">
            <img src="{{asset('storage/images')}}/{{$item->image}}" alt="">
        </div>
        @endforeach
    </div>
    <div class="description-line"> </div>
    <div class="description-container"> 
        <div class="description-title"> <h3>Mô tả sản phẩm </h3></div>
        <div class="description-content"> 
                {!! $product->description !!}
        </div>
    </div>

   
    <div class="description-container"> 
        <div class="description-title"> <h3>Sản phẩm liên quan </h3></div>
        <div class="description-content"> 
            @foreach ($related as $item)
            <a href="{{route('detail',$item->slug)}}"> 
                <img class="related-image" src="{{asset('storage/images')}}/{{$item->image}}" alt="">
            </a>
           
        @endforeach
        </div>
    </div>


@endsection

<script>
document.addEventListener("DOMContentLoaded", function() {
    const quantityInput = document.querySelector('.quantity-input');
    const quantityPlusBtn = document.querySelector('.quantity-plus');
    const quantityMinusBtn = document.querySelector('.quantity-minus');

    quantityPlusBtn.addEventListener('click', function() {
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });

    quantityMinusBtn.addEventListener('click', function() {
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        } else {
            quantityInput.value = 1;
        }
    });

    quantityInput.addEventListener('change', function() {
        if (parseInt(quantityInput.value) < 1 || isNaN(parseInt(quantityInput.value))) {
            quantityInput.value = 1;
        }
    });
});

    </script>