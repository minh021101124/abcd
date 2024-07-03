<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang thay đổi mật khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<header>
    <img src="{{ asset('assets/images/banner.png') }}" width="100%" >
</header>
<body style="background: #e8f4ff">
    <div class="row justify-content-center mt-5">
    <div class="col-lg-10" style="margin-left: 40px;">
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
                    <form action="{{ route('change-password') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                        <div class="form-group">
                            {{-- <label for="current-password">Mật khẩu hiện tại:</label> --}}
                            <input type="password" id="current-password" name="current_password" placeholder="Mật khẩu hiện tại" required class="form-control" style="background-image: url('{{ asset('assets/images/pass.png') }}'); background-size: 38px 30px; background-repeat: no-repeat; padding-left: 50px;">
                        </div>
                        </div>
                        <div class="mb-3">
                        <div class="form-group">
                            {{-- <label for="new-password">Mật khẩu mới:</label> --}}
                            <input type="password" id="new-password" name="new_password" placeholder="Mật khẩu mới" required class="form-control" style="background-image: url('{{ asset('assets/images/pass.png') }}'); background-size: 38px 30px; background-repeat: no-repeat; padding-left: 50px;">
                        </div>
                        </div>
                        <div class="mb-3">
                        <div class="form-group">
                            {{-- <label for="new_password_confirmation">Xác nhận mật khẩu mới:</label> --}}
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="Xác nhận Mật khẩu mới"required class="form-control" style="background-image: url('{{ asset('assets/images/pass.png') }}'); background-size: 38px 30px; background-repeat: no-repeat; padding-left: 50px;">
                        </div>
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


    </div>

    </div>
    {{-- <main class="main">
        <div class="container login-container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="heading mb-1">
                                <h2 class="title">Đổi Mật Khẩu</h2>
                                @if ($message = Session::get('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>

                            <form action="{{ route('change-password') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="current-password">Mật khẩu hiện tại:</label>
                                    <input type="password" id="current-password" name="current_password" required class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="new-password">Mật khẩu mới:</label>
                                    <input type="password" id="new-password" name="new_password" required class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="new_password_confirmation">Xác nhận mật khẩu mới:</label>
                                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" required class="form-control">
                                </div>

                                <button type="submit" class="btn btn-dark btn-block btn-md mb-3">Thay đổi mật khẩu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
</body>
</html>
