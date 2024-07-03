<div class="containerw">
    <form action="" method="">
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
   
   
</div>