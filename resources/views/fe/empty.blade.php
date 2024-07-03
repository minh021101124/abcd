<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="{{asset('assets')}}/styles.css">
    
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a href="{{route('index')}}">Logo</a>
            </div>
            <ul class="menu">
                <!-- Thêm thanh tìm kiếm -->
                <li>
                    <form action="/search" method="GET">
                        <input type="text" name="query" placeholder="Tìm kiếm...">
                        <button type="submit">Tìm kiếm</button>
                    </form>
                </li>
                <!-- Kết thúc phần thanh tìm kiếm -->
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('fe.catdetail', $category->id) }}">{{ $category->name }}</a>
                        @if($category->children->isNotEmpty())
                        
                            <ul class="submenu">
                                @foreach($category->children as $childCategory)
                                    <li><a href="{{ route('fe.catdetail', $childCategory->id) }}">{{ $childCategory->name }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>        
           
            <div class="cart-icon">
                <a href="{{route('cart.index')}}"><img src="{{asset('assets/shopping-bag.png')}}" width="50px" ></a>
                <span class="item-count">{{$cart->gettotalQuantity()}}</span>
            </div>
           
        </nav>
       
    </header>
    <div class="main-content">
      


        <h1>KẾT QUẢ TÌM KIẾM</h1>
        <p> Không tìm thấy kết quả phù hợp ...</p>
       

        

