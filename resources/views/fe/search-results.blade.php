@extends('fe.master')
@section('main-content')
@section('title','Kết quả tìm kiếm')
    
      


        <h1>KẾT QUẢ TÌM KIẾM</h1>

        <div class="product-container">
            @foreach ($products as $item)
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

      
        <h1>BÀI VIẾT LIÊN QUAN</h1>
            @foreach($products as $product)
            <div>
                <h2>{{ $product->name }}</h2>
                <p>{!! $product->description !!}</p>
               
            </div>
            @endforeach

        
</body>
@endsection

