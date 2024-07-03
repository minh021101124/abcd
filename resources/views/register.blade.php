<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<header>
    <img src="{{ asset('assets/images/banner.png') }}" width="100%" >
</header>
<body style="background: #e8f4ff">
   
<div class="row justify-content-center mt-5">

    
    <div class="col-lg-10">
        <div class="col-lg-6">
            
            <div class="ca" style="border: none">
                <div class="card-header" style="padding: 0px">
                   
                    <img src="{{ asset('assets/images/dang_nhap.png') }}" width="100%" >
                </div>
            </div>
        </div>

       
        <div class="" style="width: 48%; margin-left: 10px;">
            <div class="card" style="border: none">
                <div class="card-body" style="">
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                            <a href="/admin" style="text-decoration: none;color:red">Trở về</a>
                            hoặc
                            <a>
                                <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                                    @csrf
                                    @method('DELETE')
                                   
                                      <button type="submit" style="margin-left:0px;color:white;background: rgb(52, 128, 221);width:140px;height:30px; border: none; padding: 0; cursor: pointer;">
                                          <span style="font-size: 13px">Đăng nhập ngay</span>
                                      </button>
                                    
                                </form></a>
                        </div>
                    @endif
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            {{-- <label for="name" class="form-label">Name</label> --}}
                            <input type="text" name="name" class="form-control" id="name" placeholder="Tên tài khoản" required style="background-image: url('{{ asset('assets/images/email.png') }}'); background-size: 38px 30px; background-repeat: no-repeat; padding-left: 50px;">
                        </div>
                        <div class="mb-3">
                            {{-- <label for="email" class="form-label">Email address</label> --}}
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required style="background-image: url('{{ asset('assets/images/email.png') }}'); background-size: 38px 30px; background-repeat: no-repeat; padding-left: 50px;">
                        </div>
                        <div class="mb-3">
                            {{-- <label for="password" class="form-label">Password</label> --}}
                            <input type="password" name="password" class="form-control" id="password" placeholder="Mật khẩu"required style="background-image: url('{{ asset('assets/images/pass.png') }}'); background-size: 38px 30px; background-repeat: no-repeat; padding-left: 50px;">
                        </div>
                        <div class="d-grid" style="    width: 140px;
                        height: 35px;
                        border: none;
                        cursor: pointer; margin-left:35%">
                         <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                            <img src="{{ asset('assets/images/btnthayy.png') }}" width="100%" >
                         </button>
                           
                        </div>
                    </form>
                </div>
            </div>
            </div>

</body>
</html>