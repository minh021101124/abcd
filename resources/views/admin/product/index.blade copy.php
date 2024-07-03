@extends('admin.master')
@section('title','Danh sách sản phẩm')
@section('main-content')
@section('content-header')
<h1>DANH SÁCH SẢN PHẨM</h1>
<!-- Main content -->

  <div class="box-body table-responsive no-padding">
    <table class="table table-hover">
      <!-- Default box -->
        @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
              <strong>{{ $message }}</strong>
          </div>


         

        @endif        
           <a href="{{route('product.create')}}" class="btn btn-success" style="margin-left:2%; margin-top:2%">+ Thêm mới </a>   
           <tbody>
            <tr>
                <th>STT</th>
                <th>Tên </th>
                <th>Giá</th>
                <th>Giá KM</th>
                <th>Danh mục</th>
                <th>Ảnh</th>
                <th>Ngày tạo</th>

            </tr>
          @forelse ($post as $item)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$item->name}}</td>
              <td>{{$item->price}}</td>
              <td>{{$item->sale_price}}</td>
              <td>@if($item->category)
                {{$item->category->name}}
            @else
                Danh mục không tồn tại
            @endif</td>
                <td> 
                  {{-- <img src="{{asset('storage/images')}}/{{$item->image}}" alt="" width=150px height="150px"> --}}
                  <img src=" cover/{{ $item->cover }}" alt="" width=150px height="150px">
                 
                </td>
                <td>{{$item->created_at}}</td>
              <td>
                <a href="{{route('product.edit',$item)}}" class="btn btn-success">Sửa</a>          
              </td>
           
              <td>
                <form action="{{route('product.destroy',$item)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Xóa</button></form>
              </td>
            </tr>
           @empty
            <span>Chưa có dữ liệu</span>
          @endforelse
        </tbody>
    </table>
     <a href="{{route('product.trash')}}"class="btn btn-primary"><i class="fa fa-trash">Thùng rác</i></a>
    </div> 
  </div>
@endsection

