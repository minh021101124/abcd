<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{asset('assets')}}/demo.css">

</head>
<body>

    <div class="header">
      <h1>My Website</h1>
      <p>Resize the browser window to see the effect.</p>
    </div>
    
   

    <nav class="menu">
        <ul class="clearfix">
            <li><a href="{{route('index')}}">Trang chủ</a></li>
            @foreach($categories as $category)  
                <li>
                    <a href="{{ route('fe.catdetail', $category->id) }}">{{ $category->name }}<span class="arrow">&#9660;</span></a>
                        @if($category->children->isNotEmpty())
                            <ul class="sub-menu">
                                @foreach($category->children as $childCategory)
                                    <li><a href="{{ route('fe.catdetail', $childCategory->id) }}">{{ $childCategory->name }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                </li>
            @endforeach      
        </ul>
    </nav>
    
    <div class="row">
      <div class="leftcolumn">
        <div class="card">
          <h2>TITLE HEADING</h2>
          <h5>Title description, Dec 7, 2017</h5>
          <div class="product-container">
            <img src="https://th.bing.com/th/id/OIP.egtarOdlhaw-Iw3KFgv2TgHaE8?w=229&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Product Image" class="product-image">
            <div class="product-name">Tên sản phẩm</div>
            <div class="product-price">$99.99</div>
            <button class="add-to-cart-button">Thêm vào giỏ hàng</button>
            <button class="view-details-button">Xem chi tiết</button>
        </div>
        </div>
        <div class="card">
          <h2>TITLE HEADING</h2>
          <h5>Title description, Sep 2, 2017</h5>
          <div class="fakeimg" style="height:200px;">Image</div>
          <p>Some text..</p>
          <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
        </div>
      </div>
      <div class="rightcolumn">
        <div class="card">
          <h2>About Me</h2>
          <div class="fakeimg" style="height:100px;">Image</div>
          <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
        </div>
        <div class="card">
          <h3>Popular Post</h3>
          <div class="fakeimg"><p>Image</p></div>
          <div class="fakeimg"><p>Image</p></div>
          <div class="fakeimg"><p>Image</p></div>
        </div>
        <div class="card">
          <h3>Follow Me</h3>
          <p>Some text..</p>
        </div>
      </div>
    </div>
    
    <div class="footer">
      <h2>Footer</h2>
    </div>
    
    </body>