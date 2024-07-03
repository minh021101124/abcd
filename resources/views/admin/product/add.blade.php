@extends('admin.master')
@section('title','Thêm mới sản phẩm')
@section('main-content')
@section('content-header')
<h1>THÊM MỚI SẢN PHẨM</h1>
<!-- Main content -->
<!DOCTYPE html>
<html lang="en">
  
<head>
    <style>#photoPreviews div {
        margin: 5px; /* Khoảng cách giữa các hình ảnh */
        float: left; /* Hiển thị các phần tử trên cùng một hàng */
    }
    
    #photoPreviews img {
        display: block; /* Hiển thị hình ảnh là block để tránh các lỗ hổng */
        width: auto; /* Đảm bảo chiều rộng của hình ảnh tự động thích ứng */
        height: 150px; /* Đảm bảo chiều cao của hình ảnh không vượt quá 200px */
        max-width: 100%; /* Đảm bảo hình ảnh không vượt quá chiều rộng của div cha */
        max-height: 100%; /* Đảm bảo hình ảnh không vượt quá chiều cao của div cha */
    }
    
    #photoPreviews button {
        display: block; /* Hiển thị nút Xóa là block để nằm ngay dưới hình ảnh */
    }
    
    .photo-previews {
    display: flex;
    flex-wrap: wrap;
    gap: 10px; /* Adjust gap as needed */
    margin-bottom: 20px; /* Add space below images */
}

.image-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 10px;
}

.image-container img {
    max-width: 120px;
    max-height: 120px;
    margin-bottom: 5px;
}

.delete-button {
    background-color: red;
    color: white;
    border: none;
    padding: 5px;
    cursor: pointer;
    border-radius: 3px;
}

.delete-button:hover {
    background-color: darkred;
}

.form-group {
    clear: both; /* Ensure each form group is properly positioned */
    margin-bottom: 20px; /* Space between form groups */
}

    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <body>
            <!-- Content Header (Page header) -->
         
      <section class="content">      
       <div class="col-md-12">
           
            <div class="box box-primary">
              
              <form role="form" method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                @csrf
                {{-- <input type="hidden" name="selected_category_id" value="{{ $selectedCategoryId }}"> --}}
                <div class="box-body">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group @error('name') has-error @enderror">
                                <label for="">Tên sản phẩm</label>
                                <input type="input" class="form-control" id="productName" placeholder="" name="name" value="{{ old('name') }}" onkeyup="ChangeToSlug()">
                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>                        
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('slug') has-error @enderror">
                                <label for="">Đường dẫn</label>
                                <input type="input" class="form-control" id="slug" placeholder="" name="slug" value="{{ old('slug') }}">
                                @error('slug')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>            
                        </div>
                    </div>
                                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @error('price') has-error @enderror">
                                <label for="">Giá sản phẩm</label>
                                <input type="input" class="form-control" id="" placeholder="" name="price" value="{{ old('price') }}">
                                @error('price')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>      
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('sale_price') has-error @enderror">
                                <label for="">Giá khuyến mãi</label>
                                <input type="input" class="form-control" id="" placeholder="" name="sale_price" value="{{ old('sale_price') }}">
                                @error('sale_price')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                                
                 
                    
                    <div class="form-group @error('category_id') has-error @enderror">
                        <label for="category_id">Chọn danh mục</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Chọn danh mục</option>
                            <?php showCategories($categories, old('category_id')); ?>
                        </select>
                        @error('category_id')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    






                   
                    <div class="form-group @error('photo') has-error @enderror">
                        <label for="photo">Ảnh sản phẩm</label>
                        <input type="file" class="form-control" id="photoInput" placeholder="" name="photo" onchange="displayImage(event)">
                        <img id="photoPreview" src="#" alt="Ảnh sản phẩm" style="display: none; max-width: 200px; max-height: 200px;">
                        @error('photo')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    
                  
                    
                    
                   
                    <div class="form-group @error('photos') has-error @enderror">
                        <label for="photos">Ảnh mô tả</label>
                        <input type="file" class="form-control" id="photos" name="photos[]" multiple onchange="displayImages(event)">
                        <div id="photoPreviews" class="photo-previews"></div>
                        @error('photos')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    
               
    


                <div class="form-group @error('short_description') has-error @enderror">
                    <label for="">Mô tả ngắn về sản phẩm</label>
                    <textarea name="short_description" id="editor" rows="4" cols="108">{{ old('short_description') }}</textarea>
                </div>  
                <div class="form-group @error('description') has-error @enderror">
                    <label for="">Mô tả chi tiết sản phẩm</label>
                    <textarea name="description" id="editor1" rows="10" cols="80">{{ old('description') }}</textarea>
                </div>
                        
                   
                    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </div>
                </div>  
            </form>
            
            </div>
    
  
      </div>
  <div class="box-footer">
    
  </div>

</div>

      </section>
    </body>
</html>

    
  </div>
  
  
  <script src="{{ asset('script/addprod.js') }}"></script>
@endsection

<?php  
function showCategories($categories, $selectedCategoryId = null, $parent_id = 0, $char = '')
{
    foreach ($categories as $key => $item)
    {
        if ($item->parent_id == $parent_id)
        {
            echo '<option value="'.$item->id.'"';
            if ($item->id == $selectedCategoryId) {
                echo ' selected';
            }
            echo '>'.$char.$item->name.'</option>'; 
            unset($categories[$key]);                                                                
            showCategories($categories, $selectedCategoryId, $item->id, $char.'--- ');
        }
    }
}
?>

 
 @section('custom-js')
 <script src="{{asset('assets\ckeditor\ckeditor.js')}}"></script>
 <script>
  CKEDITOR.replace( 'editor1' );
</script>
<script language="javascript">
  function ChangeToSlug()
  {
      var productName, slug;

      //Lấy text từ thẻ input title 
      productName = document.getElementById("productName").value;

      //Đổi chữ hoa thành chữ thường
      slug = productName.toLowerCase();

      //Đổi ký tự có dấu thành không dấu
      slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
      slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
      slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
      slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
      slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
      slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
      slug = slug.replace(/đ/gi, 'd');
      //Xóa các ký tự đặt biệt
      slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
      //Đổi khoảng trắng thành ký tự gạch ngang
      slug = slug.replace(/ /gi, "-");
      //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
      //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
      slug = slug.replace(/\-\-\-\-\-/gi, '-');
      slug = slug.replace(/\-\-\-\-/gi, '-');
      slug = slug.replace(/\-\-\-/gi, '-');
      slug = slug.replace(/\-\-/gi, '-');
      //Xóa các ký tự gạch ngang ở đầu và cuối
      slug = '@' + slug + '@';
      slug = slug.replace(/\@\-|\-\@|\@/gi, '');
      //In slug ra textbox có id “slug”
      document.getElementById('slug').value = slug;
  }
</script>
 @endsection