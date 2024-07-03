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
        <a href="{{route('product.create')}}"  style="margin-left:2%; margin-top:2%"><button class="btnthem">+ Thêm mới   </button> </a>
           
           <tbody>
            <tr>
                <th>ID sản phẩm</th>
                <th>Tên </th>
                <th>Giá</th>
                <th>Giá KM</th>
                <th>Danh mục</th>
                <th>Ảnh</th>
                {{-- <th>Ngày tạo</th> --}}

            </tr>
             @foreach ($posts as $post)
            <tr>
                  <th scope="row">{{ $post->id }}</th>
                  <td>{{ $post->name }}</td>
                  <td>{{ $post->price }}</td>
                  <td>{{ $post->sale_price }}</td>
                  {{-- <td>{{ $post->category_id }}</td> --}}
                  <td>@if($post->category)
                    {{$post->category->name}}
                @else
                    Danh mục không tồn tại
                @endif</td>
                
                  <td>
                   
                    <img src="{{asset('images')}}/{{$post->image}}" alt="" width=150px height="150px">

                </td>
                {{-- <td>{{$post->created_at}}</td> --}}
                  <td><a href="{{route('product.edit',$post)}}" ><button class="btnsua">Sửa</button></a></td>
                  <td>
                      <form action="{{route('product.destroy',$post)}}" method="post">
                       <button class="btnxoa" onclick="return confirm('Bạn đã chắc chắn?');" type="submit">Xóa</button>
                       @csrf
                       @method('delete')
                   </form>
                  </td>

              </tr>
              @endforeach
        </tbody>
    </table>
     <a href="{{route('product.trash')}}"class="btn btn-primary"><i class="fa fa-trash">Thùng rác</i></a>
    </div> 
  </div>

  <style >
  .btnxoa{
    border: none;width: 50px;
    background: red;color: white;
  }
  .btnsua a{
    color: white;
  }
  .btnsua{
    border: none;width: 50px;color: white;
    background: rgb(9, 128, 225);
  }.btnthem{
    border: none;width: 150px;height: 40px;
    color: white;
    background: rgb(7, 74, 129);
  }
   </style>
@endsection

