<!doctype html>
<html lang="en">
<head>
	<title>CodingDung</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="{{asset('assets')}}/stype.css">
    <style>
.paymentother1 {
    text-align: center; /* Canh giữa nội dung */
}

.payment-image {
    display: inline-block; /* Hiển thị hình ảnh trên cùng một hàng */
    margin: 0 50px; /* Khoảng cách giữa hai hình ảnh */
   
    border-radius: 20px; /* Tạo viền tròn */
    overflow: hidden; /* Loại bỏ phần dư thừa nếu hình ảnh vượt ra khỏi viền tròn */
}
#vnpay{
    border: solid 2px rgb(21, 115, 223);
}
        </style>
</head>

<body>
	<div class="modal">
		<form class="form">
			<div class="paymentother1">
                <img src="{{asset('assets')}}/images/momo.jfif" width="80px" class="payment-image">
                <img src="{{asset('assets')}}/images/vnpay.jfif" width="80px" class="payment-image" id="vnpay">
            </div>
            
			<div class="separator">
				<hr class="line">
				<p>OR</p>
				<hr class="line">
			</div>
			<div class="card-info">
				<div class="input_container">
					<label class="input_label">Tên thẻ</label>
					<input class="input_field" type="text" placeholder="Nhập họ và tên">
				</div>
				<div class="input_container">
					<label class="input_label">Số thẻ</label>
					<input class="input_field" type="number" placeholder="0000 0000 0000 0000">
				</div>
				<div class="input_container">
					<label class="input_label">Ngày đăng kí</label>
					<div class="split">
						<input class="input_field" style="width: 250px;" type="text" placeholder="01/23">
						<input class="input_field" style="width: 110px;" type="number" placeholder="Nhập mã bảo mật">
					</div>
				</div>
			</div>
			<button class="checkout" style="cursor: pointer;">
				<span>Thanh toán</span>
			</button>
		</form>
	</div>
</body>
</html>
