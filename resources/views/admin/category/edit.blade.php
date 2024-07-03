@extends('admin.master')
@section('title','Danh mục')
{{-- @section('TenTrang','THÊM MỚI DANH MỤC') --}}
@section('main-content')
<!-- Main content -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Menu</title>
    <body>
            <!-- Content Header (Page header) -->
    <section class="content-header">
<h1> Cập nhật danh mục </h1>
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
       <div class="col-md-8">
            <!-- general form elements -->
            <div class="box box-primary">
              {{-- <div class="box-header with-border">
                <h3 class="box-title">Thêm mới menu</h3>
              </div> --}}
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{route('category.update',$category->id)}}">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{$category->id}}">
                <div class="box-body">
                  <div class="form-group @error('name') has-error @enderror">
                    <label for="">Tên danh mục</label>
                    <input type="input" class="form-control" id="" placeholder="" name="name" value="{{old('name') ? old('name') : $category->name}}">
                    @error('name')
                    {{-- <div class="alert alert-danger" >{{$message}}</div> --}}
                    <span class="help-block">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="" name="">Danh mục cha </label>
                    <select name="parent_id" id="input" class="form-control" >
                        <option value="">Chọn danh mục cha</option>
                        <?php $displayedCategories = []; ?>
                        @foreach ($categories as $categoryOption)
                            <option value="{{ $categoryOption->id }}" {{ $category->parent_id == $categoryOption->id ? 'selected' : '' }}>
                                {{ $categoryOption->name }}
                            </option>
                            <?php $displayedCategories[] = $categoryOption->id; ?>
                            @if(count($categoryOption->children))
                                @include('partials.category-options', ['categories' => $categoryOption->children, 'prefix' => '--'])
                            @endif
                        @endforeach
                    </select>
                </div>
                
                  
                  
                  
                
  
                 
                  <div class="form-group">
                    <label for="">Chọn trạng thái</label>
                    <div class="radio">
                      <label>
                        <input type="radio" name="status" id="input" value="1"  {{$category->status ? 'checked' : ""}}>
                        Hiện
                      </label>
                      <label>
                        <input type="radio" name="status" id="input" value="0" {{!$category->status ? 'checked' : ""}}>
                        Ẩn
                      </label>
                    </div>
                  </div>
                  
                </div>
                <!-- /.box-body -->
  
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
              </form>
            </div>
         
            <!-- /.box -->
  
          </div>
        <!-- /.box -->
  
      </section>
    </body>
</html>

    
  </div>



@endsection

