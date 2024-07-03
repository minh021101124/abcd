<header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">T MOBILE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      {{-- <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a> --}}

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
           
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="{{asset('assets')}}/images/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
           
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
           
            <ul class="dropdown-menu">
              
              {{-- <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li> --}}
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('assets')}}/images/danh.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Thông tin</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('assets')}}/images/danh.jpg" class="img-circle" alt="User Image">

                <p>
                  Danh PC - T MOBILE
                  <small>Thành lập năm 2024</small>
                </p>
                
              </li>
              <!-- Menu Body -->
              <li class="user-body">
               
               
               
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                
                <a>
              <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                  @csrf
                  @method('DELETE')
                 
                    <button type="submit" style="margin-left:25px;color:white;background: rgb(4, 108, 236);width:150px;height:50px; border: none; padding: 0; cursor: pointer;">
                        <span style="font-size: 15px">Đăng xuất</span>
                    </button>
                  
              </form></a>
                <a href="{{route('change')}}">
                  <button  type="submit" style="margin-left:25px;color:white;background: rgb(241, 103, 4);width:150px;height:50px; border: none; padding: 0; cursor: pointer;">   
                    <span style="font-size: 15px">Đổi mật khẩu</span>
                  </button>
                </a>
                <a href="{{route('register')}}">
                  <button  type="submit" style="margin-left:25px;color:white;background: rgb(17, 146, 45);width:150px;height:50px; border: none; padding: 0; cursor: pointer;">   
                    <span style="font-size: 15px">Thêm tài khoản</span>
                  </button>
                </a>
              </li>
            </ul>
          </li> 
          
        </ul>
      </div>
    </nav>
  </header>