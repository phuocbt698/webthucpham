<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Log in</title>
    <link rel="shortcut icon" href="{{ asset('asset/admin') }}/favicon.ico" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/dist/css/style.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/plugins/toastr/toastr.min.css">
    <!-- jQuery -->
    <script src="{{ asset('asset/admin') }}/plugins/jquery/jquery.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('asset/admin') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="{{ asset('asset/admin') }}/plugins/toastr/toastr.min.js"></script>
    <!-- js Custom -->
    <script src="{{ asset('js') }}/ajax.js"></script>
    <script src="{{ asset('js') }}/toast.js"></script>
    <script src="{{ asset('js') }}/renderError.js"></script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1><b>Admin</b></h1>
            </div>
            <div class="card-body">
                <div class="typewriter">
                    <p class="login-box-msg">Chào mừng bạn đến với trang quản trị!</p>
                </div>

                <form id="formLogin" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input name="email" type="email" class="form-control" placeholder="Email">
                        <div id="email" class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div  class="input-group mb-3">
                        <input name="password" type="password" class="form-control" placeholder="Password">
                        <div  id="password" class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div id="login"></div>
                    <div class="row d-flex justify-content-end">
                        <!-- /.col -->
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <script src="{{ asset('asset/admin') }}/dist/js/adminlte.min.js"></script>
    <script>
        $('#formLogin').submit(function(event) {
            event.preventDefault();
            var eleValidate = [
                'email',
                'password'
            ];
            var data = new FormData(this);
            var url = "{{ route('admin.login') }}";
            var result = sendAjax(url, data, 'login');
            if (!result.href) {
                if(result['login']){
                    renderError(result, ['login']);
                    removeError(eleValidate, 'formLogin');
                }else{
                    renderError(result, eleValidate);
                    removeError(['login'], 'formLogin');
                }
            }else{
                window.location.replace(result.href);
            }
        });
    </script>
</body>
@if (Session::has('message'))
<script>
    toastMessageDanger('{{Session::get('message')}}');
</script>
@endif
</html>
