@extends('fe.master')
@section('main-content')
@section('title','Giỏ hàng')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    .container11 {
        width: 100%;
        height: auto;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        display: flex;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #ffffff;
    }

    .product-info img {
        max-width: 100px;
        height: auto;
        margin-right: 20px;
    }

    .quantity-input {
        width: 50px;
        text-align: center;
    }

    .remove-btn {
        color: #ff0000;
        cursor: pointer;
    }

    .subtotal {
        font-weight: bold;
    }
    .thanhtoan{
        color:red;
    }
    .btn-tt {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #b34800;
}
a {
    text-decoration: none;color:rgb(0, 0, 0)
}
.left{
    width: 90%;
    height: 100px;
    background: #ffffff;
    height: auto;
}

</style>
</head>
<body>


    {{-- @if(session('error'))
    <div class="alert alert-danger" style="color: red;">
        {{ session('error') }}
    </div>
    @endif --}}
<div class="container11">
    {{-- <h2>Giỏ hàng của bạn</h2> --}}
    <div class="left">
        <table>
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th></th>
                </tr>
            </thead>
            @foreach ($cart->list() as $key => $value)
            
            <tbody>
    
                <tr>
                    <td class="product-info">
                        <img src="{{ asset('images/' . $value['image']) }}" alt="Product Image">
                    </td>
                    <td style="color:rgb(10, 169, 10)">
                        {{ $value['name'] }}
                       
               
                    </td>
                    <td>{{ number_format($value['price']) }}đ</td>
                    
                    <td>
                        <input type="number" class="quantity-input1" value="{{ $value['quantity'] }}">
                        
                    </td>
       
                    <td>{{ number_format($value['price'] * $value['quantity']) }}đ</td>
    
                    <td>
                        @foreach (session('cart', []) as $item)
    <td>
        @foreach (session('cart', []) as $item)
        <td>
            @if (isset($item['status']) && $item['status'] === 'paid')
                <span class="paid-label">Đã thanh toán</span>
            @elseif (isset($item['status']) && $item['status'] === 'pending')
                <span class="pending-label">Đang chờ xử lý</span>
            @else
                <!-- Thêm link xóa sản phẩm -->
                <form action="{{ route('cart.remove') }}" method="POST">
                    @csrf
                    <input type="hidden" name="productId" value="{{ $item['productId'] }}">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            @endif
        </td>
    @endforeach
    
    </td>
@endforeach

                    </td>
                </tr>
                <!-- Thêm các hàng sản phẩm khác ở đây -->
            </tbody>
            @endforeach
            
            <thead>
                <tr>
                    <th></th>
                    <th>Tổng số sản phẩm:</th>
                    <th class="thanhtoan">{{$cart->gettotalQuantity()}}</th>
                    <th>Tổng thanh toán:</th>
                    <th class="thanhtoan" >{{ number_format($cart->gettotalPrice()) }}đ</th>
                  
                    <th><!-- Thêm nút thanh toán -->
                        {{-- <form action="{{ route('checkout') }}" method="GET">
                            <button type="submit" class="btn-tt">Thanh toán</button>
                        </form></th> --}}
                        <form action="{{url('/vnpay_payment')}}" method="POST"> 
                            @csrf
                            <input type="hidden" name="total" value="{{$cart->gettotalPrice()}}">
                            <button type="submit" name="redirect" class="btn-tt" >Thanh toán VN PAY</button>
                           </form>
                           <button type="button" name="" id="InfoTT" class="btn-tt" >Thanh toán</button>
                           <script>
                            document.getElementById("InfoTT").addEventListener("click", function() {
                                var cartItems = {!! json_encode(session('cart')) !!};
                                if (cartItems === null || Object.keys(cartItems).length === 0) {
                                    alert("Giỏ hàng trống. Vui lòng thêm sản phẩm vào giỏ hàng trước khi thanh toán.");
                                } else {
                                    // Chuyển hướng đến route để xuất hóa đơn
                                    window.location.href = "{{ route('checkout_infor') }}";
                                }                        
                            });
                        </script>
                           {{-- <button type="button" class="btn-tt" id="exportButton">Xuất Hóa Đơn</button>
    
                           <script>
                            document.getElementById("exportButton").addEventListener("click", function() {
                                // Chuyển hướng đến route để xuất hóa đơn
                                window.location.href = "{{ route('export.invoice') }}";
                            });
                        </script> --}}
                        
                           
                </tr>
            </thead>
        </table>
    </div>
    {{-- <div class="right">
    </div> --}}
    
   
   
    
</div>
</body>

@endsection

<script>
function removeFromCart(productId) {
    $.ajax({
        url: '{{ route("cart.remove") }}',
        method: 'POST',
        data: {
            productId: productId
        },
        success: function(response) {
            console.log('Xóa sản phẩm thành công');
            // Cập nhật giao diện người dùng tương ứng (ví dụ: cập nhật giỏ hàng, hiển thị thông báo)
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi xóa sản phẩm:', error);
        }
    });
}

</script>
