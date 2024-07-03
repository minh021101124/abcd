   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('assets')}}/images/th.jfif" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>ADMIN</p>
        <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
          @csrf
          @method('DELETE')
          <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
              <img src="{{ asset('assets/images/logout.png') }}" width="20px" style="background: rgb(128, 126, 132)" alt="Logout">
              <span style="font-size: 10px">Đăng xuất</span>
          </button>
        
      </form>
      
      
        {{-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> --}}
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->

    <ul class="sidebar-menu" data-widget="tree">

      <li>
        <a href="{{route('category.index')}}">
          <i class="fa fa-th"></i> <span>Quản lý danh mục </span>
          <span class="pull-right-container">
         
          </span>
        </a>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Quản lý sản phẩm </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('product.index')}}"><i class="fa fa-circle-o"></i> Danh sách sản phẩm </a></li>
          <li><a href="{{route('product.create')}}"><i class="fa fa-circle-o"></i> Thêm mới sản phẩm </a></li>
        </ul>
      </li>
      <li>
        <a href="{{route('avatar.index')}}">
          <i class="fa fa-th"></i> <span>Quản lí Ảnh trang chủ</span>
         
        </a>
      </li>
      <li>
        <a href="{{route('banner.index')}}">
          <i class="fa fa-th"></i> <span>Quản lí banner</span>
         
        </a>
      </li>
      
      <li>
        <a href="{{route('admin.statistic')}}">
          <i class="fa fa-th"></i> <span>Thống kê</span>
         
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->