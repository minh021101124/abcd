@extends('admin.master')
@section('title','Thống kê')
@section('main-content')
@section('content-header')
<h1>THỐNG KÊ ĐƠN HÀNG</h1>

    <div class="box-body table-responsive no-padding">
      
      <table class="table table-hover" style="margin-left:2%; margin-top:5%">
            <!-- Default box -->

            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
            </div>
            @endif
         <tbody>
            <tr>
                <th>Id đơn hàng</th>
                <th>Tên khách hàng</th>
                <th>Danh số điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Thanh toán</th>
                <th></th>
            </tr>
            {{-- @foreach($records as $record)
            <tr>
                <td> {{ $record->id }}  </td>
                <td> {{ $record->name }}  </td>
                <td> {{ $record->phone }}  </td>
                <td> {{ $record->email }}  </td>
                <td> {{ $record->address }}  </td>
                <td> {{ $record->product_name }}  </td>
                <td> {{ $record->quantity }}  </td>
                <td> {{ number_format($record->total_amount) }}<b>VND</b></td>
            </tr>
            
            @endforeach --}}
            @foreach($records as $record)
            @foreach($record->invoices as $invoice)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->name }}</td>
                    <td>{{ $record->phone }}</td>
                    <td>{{ $record->email }}</td>
                    <td>{{ $record->address }}</td>
                    <td>{{ $invoice->product_name }}</td>
                    <td>{{ $invoice->quantity }}</td>
                    <td>{{ number_format($invoice->total_amount) }}<b> VND</b></td>
                </tr>
            @endforeach
        @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <th>Tổng số tiền:</th>
                <td>{{ number_format($Tong)}}<b>VND</b></td>
                <td></td>
            </tr>
        </tbody>


    </table>
      </div>
  </div>



@endsection

