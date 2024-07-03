<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="{{asset('assets')}}/styles.css">
    
   
   
    <style>
      
    </style>
</head>
<body>
    <header style="">
       <div class="container">
            <div class="top-div"style="padding: 20px">  
                <div class="logo">
                    <a href="{{route('index')}}">
                        @foreach ($im as $ite)
                         <img src="{{ asset('imageavatar/' . $ite->avatar) }}"   width="170px" height="130px">
                        @endforeach
                    </a>
                </div>
                <div class="timk" style="padding: 20px">
                    <form action="/search" method="GET">
                        <input type="text" name="query" placeholder="Tìm kiếm...">
                        <button type="submit">Tìm</button>
                    </form>
                </div>
                
                <div class="cart-icon">
                    <a href="{{route('cart.index')}}"><img class="img-cart" src="{{asset('assets/shopping-bag.png')}}" width="60px" ></a>
                    <span class="item-count">{{$cart->gettotalQuantity()}}</span>
                </div>
                
            </div>
            <div class="bottom-div" style="">
               
                <ul class="menu" style="justify-content: center; ">
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
                                    @foreach($category->children as $childCategory)
                                        <li>
                                            <a href="{{ route('fe.catdetail', $childCategory->id) }}">{{ $childCategory->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach --}}
                    @foreach($categories as $category)
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
@endforeach

                </ul>
            </div>
        </div>
    </header>
    <div class="content">
        <div class="container">
            <div class="content1">
                @yield('main-content') 
        </div>
        </div>
    </div>

    <style> 
    .table-container{ justify-content: center;gap: 80px;
        display: flex;
    }
        .tb1{width: 180px;padding-top: 50px;padding-bottom: 30px;}
        .tb1 a{ text-decoration: none ; color: black;}
    </style>
    <footer>
        <div class="container f">
             <div class="table-container" style="background: rgb(237, 239, 216)">
        <table class="tb1">
        <tr>
            <td> 
                <b>VỀ CHÚNG TÔI</b><br>
                <a href="">Giới thiệu</a><br>
                <a href="">Hệ thống cửa hàng</a><br>
                <a href="">Chính sách nội dung</a><br>
                <a href="">Chính sách giao hàng</a>
            </td>
        </tr>
        <table class="tb1">
        <tr>
            <td> 
                <b>DANH MỤC</b><br>
                @foreach($categories as $category)
              
                    <a href="{{ route('fe.catdetail', $category->id) }}">
                        {{ $category->name }}</a><br>
                        @endforeach
               
            </td>
        </tr>
        </table>
        <table class="tb1">
        <tr>
            <td> 
                <b>TÌM HIỂU THÊM</b><br>
                <a href="">Giới thiệu</a><br>
                <a href="">Hệ thống cửa hàng</a><br>
                <a href="">Chính sách nội dung</a><br>
                <a href="">Chính sách giao hàng</a>
            </td>
        </tr>
        </table>
        <table class="tb1">
                <tr>
                <td> 
                    <b>TỔNG ĐÀI</b><br>
                    <a href="">Giới thiệu</a><br>
                    <a href="">Hệ thống cửa hàng</a><br>
                    <a href="">Chính sách nội dung</a><br>
                    <a href="">Chính sách giao hàng</a>
                </td>
            </tr>
        </table>

        
    </table>
    </div>
        </div>
    </footer>
</body>
</html>
