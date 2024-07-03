@extends('fe.master')
@section('title','Sản phẩm của danh mục')
@section('main-content')
<link rel="stylesheet" href="{{asset('assets')}}/styles.css">
<link rel="stylesheet" href="{{asset('assets')}}/stype.css">
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
           <form action="{{url('/vnpay_payment')}}" method="POST"> 
            @csrf
            <span>Thanh toán bằng Vnpay</span>
           </form>
        </button>
    </form>
</div>
@endsection