{{-- @extends('fe.master')
@section('main-content') --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <link rel="stylesheet" href="{{asset('assets')}}/styles.css">
</head>
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
<body>
   
   <div style="margin-left: 30px; margin-right:30px" >
    @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
       
        @if(session('message')) 
            <button type="button" class="btn1 btn1-secondary" id="exportButton">Xuất Hóa Đơn</button>
        @endif
        <a href="{{ route('index') }}">,Trở về Trang chủ</a>
    </div>
    
    @endif
<span style="text-align: center"><h1>THANH TOÁN</h1></span>
    
  
</head>
<body>

<div class="containerw">
    <form action="{{ route('checkout_infor.store') }}" method="POST">
        @csrf

        <div class="trum">
        <div class="info">     <div class="form-group">
            <label for="customer_name">Tên Khách Hàng:</label>
            <input type="text" id="customer_name" name="name" required>
        </div>

        <div class="form-group">
            <label for="address">Địa Chỉ:</label>
            <input type="text" id="address" name="address" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="phone">Điện Thoại:</label>
            <input type="text" id="phone" name="phone" required>
        </div>
    </div>
    <div class="procc">
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên SP</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                    <th>Thành Tiền</th>
                </tr>
            </thead>
            <tbody>
               
                  @php
                  $totalAmount = 0;
                  $cart = session('cart');
              @endphp
              @if ($cart !== null)
                  @foreach($cart as $key => $product)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $product['name'] }}</td>
                          <td>{{ number_format($product['price']) }}</td>
                          <td>{{ $product['quantity'] }}</td>
                          <td>{{ number_format($product['price'] * $product['quantity']) }}</td>
                      </tr>
                      @php
                          $totalAmount += $product['price'] * $product['quantity'];
                      @endphp
                  @endforeach
              
                  <tr>
                      <td colspan="4" align="right"><strong>Tổng Tiền:</strong></td>
                      <td>{{ number_format($totalAmount) }}</td>
                  </tr>
              @else
                  
                  <tr>
                      <td colspan="5">Giỏ hàng trống.</td>
                  </tr>
              @endif
            </tbody>
        </table>
    </div>
      
        </div>
        <button type="submit" class="btn1">Xác nhận</button>
       
    </form>
    {{-- <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <label for="email">Địa chỉ Email:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Thanh toán</button>
    </form> --}}
    <script>
       
        var formSaved = false;
    
        
        document.querySelector('.btn1').addEventListener('click', function() {
          
            formSaved = true;
          
            document.getElementById("exportButton").style.display = "inline";
        });
    
      
    </script>
</div>
</body>

    <!-- Script để chuyển hướng đến route để xuất hóa đơn -->
    <script>
         document.getElementById("exportButton").addEventListener("click", function() {
             window.location.href = "{{ route('export.invoice') }}";
         });
    </script>
   </div>
</body>
</html>



{{-- @endsection --}}

<style>
       

    .containerw {
        width: 100%;
       
        background: #fff;
        padding: 20px;
        border-radius: 8px;
       
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    input[type="email"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        margin-top: 5px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #0758c3;color: #fff;
    }

    tbody td:last-child {
        text-align: right;
    }

    .btn1 {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
    }

    .btn1-secondary {
        background-color: #6c757d;
    }

    .btn1:hover {
        background-color: #0056b3;
    }

    .btn1-secondary:hover {
        background-color: #5a6268;
    }
    .trum{
        display: flex;
    }
    .info{
        width: 250px;
    }
    .procc{
        margin-left: 30px;
        width: 700px;
    }
</style>