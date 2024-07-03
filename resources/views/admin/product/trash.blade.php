@extends('admin.master')
@section('title','Danh sách sản phẩm')
@section('main-content')
@section('content-header')
<h1>DANH SÁCH SẢN PHẨM ĐÃ XÓA</h1>
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
        <a href="{{route('product.index')}}" class="btn btn-success" style="margin-left:2%; margin-top:2%"><- Quay về </a>   
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
            
            @forelse ($products as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->sale_price}}</td>
                <td>
                    @if($item->category)
                        {{$item->category->name}}
                    @else
                        Danh mục không tồn tại
                    @endif
                </td>
                <td> 
                    <img src="{{asset('images')}}/{{$item->image}}" alt="" width="150px" height="150px">
                </td>
                <td>{{$item->created_at}}</td>
                
                <td>
                    <a href="{{route('product.restore',$item->id)}}" class="btn btn-success">Khôi phục</a>
                    <a href="{{route('product.forceDelete',$item->id)}}" onclick="return confirm('Xóa vĩnh viễn !')"  class="btn btn-danger">Xóa vĩnh viễn</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="9">Chưa có dữ liệu</td></tr>
        @endforelse
        {{-- <form id="deleteForm" action="{{ route('products.forceDeleteMultiple') }}" method="post">
          @csrf
          @method('DELETE')
          <input type="hidden" id="selectedProducts" name="selectedProducts">
          <button type="button" id="deleteSelected" class="btn btn-danger">Xóa vĩnh viễn</button>
      </form> --}}
      <script>
        document.getElementById('deleteSelected').addEventListener('click', function() {
            var selectedProducts = [];
            var checkboxes = document.querySelectorAll('input[name="product_ids[]"]:checked');
            checkboxes.forEach(function(checkbox) {
                selectedProducts.push(checkbox.value);
            });
            document.getElementById('selectedProducts').value = JSON.stringify(selectedProducts);
            document.getElementById('deleteForm').submit();
        });
    </script>
    
        </tbody>
    </table>
     {{-- <a href="{{route('product.trash')}}"class="btn btn-primary"><i class="fa fa-trash">Thùng rác</i></a> --}}
    </div> 
  </div>
@endsection

