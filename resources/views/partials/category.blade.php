
<style>
.product-list{
    max-width: 100%;
    height: 200px;
}
.product-item-small {
   margin: 5px ;
    width: 140px;height: 110px;
    background-color: #ffffff;
    border-radius:  1rem;
    overflow: hidden;
    cursor: pointer; 
    border: 2px solid transparent; 
    transition: border 0.3s;
}
.product-details-small {
    margin-top: 5px;
    padding: 5px;
    max-height: 150px; /* Giới hạn chiều cao */
    width: 90px;
}
.product-detailss-small{
    margin-top: 5px;
}
.product-image-small {
   width: 60px;height: 40px;
    
    display: block; 
    margin: 5px ; 
    box-sizing: border-box;
}
.product-title-small {
    font-size: 10px;
    margin-bottom: 2px; /* Tăng khoảng cách dưới lên 10px */
    display: -webkit-box; /*ngat dong*/
    -webkit-box-orient: vertical; 
    -webkit-line-clamp: 1; 
    overflow: hidden; 
    text-overflow: ellipsis; /*...*/
    line-height: 0.9em; 
    max-height: 0.9em; 
}
.product-price-small,
.product-discount-small {
    display: flex; 
    align-items: center;
    font-weight: 300;
    color: #045ab1;
    font-size: 0.75em;
    font-family: Arial;
    line-height: 5px;
  
}

.product-discount-small {
    color: #a09c9b;
    text-decoration: line-through;
    font-size: 0.7em;
    margin-inline-start: auto;
    margin-block-end: 1px;
    margin-inline-end: 1px;
}
</style>

@foreach ($categories as $category)
    <li>
        <a href="{{ route('fe.catdetail', $category->id) }}">
            {{ $category->name }}
            @if ($category->childrenCategories->isNotEmpty())
                <div class="arrow"></div>
            @endif
        </a>
 
        @if ($category->products->isNotEmpty())
            {{-- <ul class="product-list">
                @foreach ($category->products as $product)
                    <li class="product-item-small">
                        <a href="{{ route('detail', $product->slug) }}">
                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="product-image-small" >
                            <div class="product-details-small">
                                <h2 class="product-title-small">{{ $product->name }}</h2>
                                @if ($product->sale_price)
                                    <p class="product-price-small">{{ number_format($product->sale_price) }}đ <span class="product-discount-small">{{ number_format($product->price) }}đ</span></p>
                                @else
                                    <p class="product-price-small">{{ number_format($product->price) }}đ</p>
                                @endif
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul> --}}
        @endif
      
        @if ($category->childrenCategories->isNotEmpty())
            <ul class="submenu">
                @include('partials.category', ['categories' => $category->childrenCategories])
            </ul>
        @endif
    </li>
@endforeach


{{-- @foreach($categories as $category)
    <li>
        <a href="{{ route('fe.catdetail', $category->id) }}">
            {{ $category->name }}
            @if($category->children->isNotEmpty())
                <div class="arrow"></div>
            @endif
        </a>
        @if($category->children->isNotEmpty())
            <ul class="submenu">
                @include('partials.category', ['categories' => $category->children])
            </ul>
        @endif
    </li>
@endforeach --}}