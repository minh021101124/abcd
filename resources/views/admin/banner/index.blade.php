@extends('admin.master')
@section('title','Quản lí banner')
@section('main-content')
@section('content-header')
<h1>Quản lí hình ảnh banner - Quảng cáo</h1>
<div class="parent-container">
   
  
</div>
<div class="box-body table-responsive no-padding">
    <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display: flex;">
            <input type="file" id="cover" name="cover" style="background: white" ><button type="submit" style="background:rgb(12, 164, 55);border:none;color:white;margin:10px;width:100px;height:40px">Tải ảnh lên</button>
        </div>
        
    </form>
</div>
<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
        <tbody>
            @foreach ($imag as $post)
            <tr>
                <td>
                    <img src="{{ asset('imagebanner/' . $post->cover) }}" alt="" width="580px" height="160px">
                </td>
                <td>
                    <form action="{{ route('deleteimage', $post->id) }}" method="post" class="image-delete-form">
                        @csrf
                        @method('delete')
                        <button type="submit" class="delete-button10" style="border:none; background:none;">
                            <img src="{{ asset('assets/images/delete.png') }}" style="width:25px">
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<style>
.delete-button10{
    position: absolute; left: 580px;
    margin-top: -10px;
}
</style>


@endsection

