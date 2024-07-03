<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
   
</head>


<style>
@font-face 
{
    font-family: "DejaVu Sans"; 
    src: url("/fonts/DejaVuSans.ttf"); 
     } 
     body 
     { 
        font-family: "DejaVu Sans";
        
        }
        p{
            line-height: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse; /* Ensures that the table borders are collapsed into a single border */
        }
        th, td {
            /* border: 1px solid black; Adds a border to table headers and data cells */
            padding: 0px; /* Adds padding to cells for better readability */
            text-align: left; /* Aligns text to the left */
        }

        
        .pr{
            border: 1px solid black;text-align: left;
            padding: 5px;
        }
        #sl{
            text-align: center;
        }
        td{
            line-height: 13px;
        }
</style>


<body>
    
    <p style="color: red; font-weight:700">
        CỬA HÀNG THUỐC TÂY TIỀN GIANG
    </p>
    <p>Địa chỉ: Thân Cửu Nghĩa, Tiền Giang, VN</p>
    <p>Điện thoại: 0123456789</p>
    <p>Website: www.thuoctaytg.com </p><br><br>
    
    <p style="text-align: center;font-size:30px;"><b>HÓA ĐƠN BÁN HÀNG</b> </p>
   
    <table> 
        <tr>
            <td style="width:150px">
                <p>Tên khách hàng  :</p>
            </td>
            <td>
                <p>{{ $customer_name }}</p>
            </td>
           
        </tr>
        <tr>
            <td>
                <p>Địa chỉ  :</p>
            </td>
            <td>
                <p>{{ $address }}</p>
            </td>
            
        </tr>
        <tr> 
             <td style="width:150px">
            <p>Điện thoại  :</p>
        </td>
        <td>
            <p>{{ $phone }}</p>
        </td>
        </tr>
        <tr>
            <td>
                <p>Mã số hóa đơn  :</p>
            </td>
            <td>
                <p>{{  $invoice_number }}</p>
            </td>
           
        </tr>
    </table>
   
    
    <table class="product">
        <thead>
            <tr>
                <th class="pr" >STT</th>
                <th class="pr" >Tên SP</th>
                <th class="pr" >Giá</th>
                <th class="pr" >Số Lượng</th>
                <th class="pr" >Thành Tiền</th>
            </tr>
        </thead>
        <tbody>
          
            @php
                $totalAmount = 0; 
            @endphp
            @foreach(session('cart') as $key => $product)
                <tr>
                    <td class="pr">{{ $loop->iteration }}</td>
                    <td class="pr">{{ $product['name'] }}</td>
                    <td class="pr">{{ number_format($product['price']) }}đ</td>
                    <td class="pr" id="sl">{{ $product['quantity'] }}</td>
                    <td class="pr">{{ number_format($product['price'] * $product['quantity']) }}đ</td>
                </tr>
                @php
                    $totalAmount += $product['price'] * $product['quantity']; // Cộng dồn số tiền của sản phẩm vào tổng số tiền
                @endphp
            @endforeach
            
            <tr>
                <td class="pr" colspan="4" align="right"><strong>Tổng tiền:</strong></td>
                <td class="pr">{{ number_format($totalAmount) }}đ</td>
            </tr>
        </tbody>
    </table>
    <span style="margin-left: 460px">Quản lý </span>
</body>
</html>
