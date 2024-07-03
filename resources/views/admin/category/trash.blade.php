@extends('admin.master')
@section('title','Danh mục')
@section('TenTrang','QUẢN LÍ DANH MỤC')
@section('main-content')
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
          <tbody>
            <tr>
                <th>STT</th>
                <th>Tên danh mục</th>
                <th>Danh mục cha</th>
                <th>Ngày tạo</th>
                <th>Trạng thái</th>
                <th></th>
            </tr>
          @forelse ($categories as $item)
      <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$item->name}}</td>
          <td>{{$item->parent_id}}</td>
          <td>{{$item->create_at}}
          <td>{!!$item->status ? '<span class="label label-success">Hiển thị</span> ':' <span class="label label-success">Ẩn hiển thị</span>'!!}</td>
          <td>
            <a href="{{route('category.restore',$item->id)}}" class="btn btn-success">Khôi phục</a>
            <a href="{{route('category.forceDelete',$item->id)}}" onclick="return confirm('Xóa vĩnh viễn !')"  class="btn btn-danger">Xóa vĩnh viễn</a>
          </td>
     </tr>
          @empty
              <span>Chưa có dữ liệu</span>
          @endforelse
        </tbody>
    </table>
      </div>
  </div>
@endsection

