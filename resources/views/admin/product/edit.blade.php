@extends('admin.master')
@section('title','Cập nhật sản phẩm')
@section('main-content')
@section('content-header')
<h1>CẬP NHÂT THÔNG TIN SẢN PHẨM</h1>
<!-- Main content -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    .parent-container {
        display: flex;
    flex-direction: column;
}
.div1 {
   margin-top: 10px;
    font-weight: 700;
}

.div2 {
    margin-top: 5px;
    
    position: relative; 
   
}

.image-wrapper {
    
    position: relative;
}

.delete-button1 {
    position: absolute;
    top: -8px; /* Điều chỉnh vị trí dấu x phía trên ảnh */
    left: 60px; /* Điều chỉnh vị trí dấu x phía bên phải của ảnh */
    background: transparent;
    border: none;
    cursor: pointer;
}

.delete-icon {
    font-size: 40px; /* Điều chỉnh kích thước của dấu x */
    color: red; /* Màu của dấu x */
}
.image-text2{
    font-size: 15px;
    margin-top: 20px;
    color:rgb(0, 0, 0);
}
</style>
<style>
    .delete-button {
        background-color: #e6283b;
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 14px;
        line-height: 18px;
        text-align: center;
        cursor: pointer;
        position: absolute;
        top: 2px;
        right: 2px;
        z-index: 1;
    }
    .image-container {
        position: relative;
        display: inline-block;
        margin-right: 10px;
    }
</style>

<body>
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="row">
            <div class="col-md-11">    
            <div class="col-md-9">
                
                <!-- Nội dung div thứ nhất -->
                <div class="box box-primary">
                    
                    <!-- Form here -->
                    <form role="form" method="POST" action="{{route('product.update',$product)}}"
                        enctype="multipart/form-data">
                        @csrf @method('PUT')
                        {{-- chỉnh sửa dòng dưới này để update ko lỗi --}}
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group @error('name') has-error @enderror">
                                        <label for="">Tên sản phẩm</label>
                                        <input type="input" class="form-control" id="productName" placeholder=""
                                            name="name" value="{{ $product->name }}" onkeyup="ChangeToSlug()">
                                        @error('name')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('slug') has-error @enderror">
                                        <label for="">Đường dẫn</label>
                                        <input type="input" class="form-control" id="slug" placeholder="" name="slug"
                                            value="{{ $product->slug }}">
                                        @error('slug')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group @error('name') has-error @enderror">
                                        <label for="">Giá sản phẩm</label>
                                        <input type="input" class="form-control" id="" placeholder="" name="price"
                                            value="{{$product->price}}">
                                        @error('name')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('name') has-error @enderror">
                                        <label for="">Giá khuyến mãi</label>
                                        <input type="input" class="form-control" id="" placeholder="" name="sale_price"
                                            value="{{ $product->sale_price }}">
                                        @error('name')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            

                            <div class="row">
                               
                                <div class="col-md-6">
                                    <div class="form-group @error('photo') has-error @enderror">
                                        <label for="photo">Ảnh sản phẩm</label>
                                        <div class="input-group">
                                            <!-- Ẩn input type file -->
                                            <input type="file" id="single_photo_input" name="photo" class="form-control" style="display: none;" onchange="displaySingleImage(event)">
                                            <!-- Phần tử label để mở tệp hình ảnh -->
                                            <label for="single_photo_input" class="input-group-addon btn btn-primary">Chọn ảnh</label>
                                            <!-- Input field để hiển thị tên file ảnh -->
                                            <input type="text" class="form-control" id="single_image_name" value="{{ $product->image }}" readonly>
                                        </div>
                                        <div id="single_image_preview" style="margin-top: 10px;"></div>
                                        <button type="button" class="btn btn-danger" id="remove_image_button" style="margin-top: 10px; display: none;" onclick="removeSingleImage()">Xóa ảnh</button>
                                        @error('photo')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                               
                                
                               
                           

                            
                                <div class="col-md-6">
                                    
                                  
                                    <div class="form-group @error('photos') has-error @enderror">
                                        <label for="photos">Ảnh sản phẩm (nhiều ảnh)</label>
                                        <div class="input-group">
                                            <!-- Ẩn input type file -->
                                            <input type="file" id="multiple_photos_input" name="photos[]" class="form-control" style="display: none;" onchange="displayMultipleImages(event)" multiple>
                                            <!-- Phần tử label để mở tệp hình ảnh -->
                                            <label for="multiple_photos_input" class="input-group-addon btn btn-primary">Chọn ảnh</label>
                                            <!-- Input field để hiển thị tên file ảnh -->
                                            <input type="text" class="form-control" id="multiple_images_name" value="" readonly>
                                        </div>
                                        <div id="imagePreview"></div>
                                        @error('photos')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                 
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                            <?php
                          $selectedCategoryId = $product->category_id ?? ''; // Gán ID của danh mục của sản phẩm vào biến $selectedCategoryId, nếu không có sản phẩm nào được chọn thì gán giá trị mặc định là chuỗi rỗng
                          ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @error('category_id') has-error @enderror">
                                        <label for="category_id">Chọn danh mục</label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="">Chọn danh mục</option>
                                            <?php showCategories($categories, $selectedCategoryId); ?>
                                        </select>

                                        @error('category_id')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group @error('short_description') has-error @enderror">
                                <label for="short_description">Mô tả ngắn về sản phẩm</label><br>
                                <textarea id="short_description" name="short_description" rows="4" cols="70">{{ $product->short_description }}</textarea>
                                @error('short_description')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group @error('description') has-error @enderror">
                                <label for="">Mô tả chi tiêt sản phẩm</label>
                                <textarea name="description" id="editor1" rows="10"
                                    cols="20">{{ $product->description }}</textarea>
                                @error('description')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                           
                        </div>
                        
                    </form>

                </div>
            </div>
            
            <div class="col-md-3" style="background-color: rgba(238, 239, 239, 0.974);height:100%" >
                <div class="row">
                    <div class="col-lg-12">
                        <div class="parent-container">
                            <div class="div1">
                                <span class="image-text2">Ảnh sản phẩm: </span>
                            </div>
                            <div class="div2">
                                <img id="single_product_image" src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width:240px; border-radius: 5px;background-color: transparent;">
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="image-text2"><span  style="font-weight:700">Ảnh mô tả: </span></div>
                @if (count($product->images) > 0)
                @php
                    $imageCount = count($product->images);
                @endphp
            
                <div class="row">
                    @for ($i = 0; $i < $imageCount; $i+=2)
                        <div class="col-lg-6">
                            @if ($i < $imageCount)
                                <div class="image-wrapper">
                                    <form action="{{ route('deleteimagepro', $product->images[$i]->id) }}" method="post" class="image-delete-form">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="delete-button1">
                                            <img src="{{asset('assets')}}/images/delete.png" style="width:25px">
                                        </button>
                                    </form>
                                    <img src="{{ asset('images_many/' . $product->images[$i]->image) }}" class="img-responsive" style="height: 90px;width: 130px; border-radius: 5px; margin-bottom: 10px;" alt="">
                                </div>
                            @endif
                            @php
                                $nextIndex = $i + 1;
                            @endphp
                            @if ($nextIndex < $imageCount)
                                <div class="image-wrapper">
                                    <form action="{{ route('deleteimagepro', $product->images[$nextIndex]->id) }}" method="post" class="image-delete-form">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="delete-button1">
                                            <img src="{{asset('assets')}}/images/delete.png" style="width:25px">
                                        </button>
                                    </form>
                                    <img src="{{ asset('images_many/' . $product->images[$nextIndex]->image) }}" class="img-responsive" style="height: 100px;width: 120px; border-radius: 5px; margin-bottom: 10px;" alt="">
                                </div>
                            @endif
                        </div>
                    @endfor
                </div>
            @endif
            

            </div>
            
            </div>
        </div>




        {{-- <div class="box-footer"></div> --}}
        </div>
    </section>
</body>

</html>


</div>

<script src="{{ asset('script/editprod.js') }}"></script>

@endsection



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
<?php  
function showCategories($categories, $selectedCategoryId, $parent_id = 0, $char = '')
{
  foreach ($categories as $key => $item)
  {
      if ($item->parent_id == $parent_id)
      {
          $selected = ($selectedCategoryId == $item->id) ? 'selected' : ''; // Kiểm tra nếu danh mục này là được chọn
          echo '<option value="'.$item->id.'" '.$selected.'>'.$char.$item->name.'</option>'; 
          unset($categories[$key]);                                                                
          showCategories($categories, $selectedCategoryId, $item->id, $char.'--- ');
      }
  }
}
?>

