<html lang="en"><head>
    <meta charset="utf-8">
    <title>Register | {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('css/app-creative.min.css')}}" rel="stylesheet" type="text/css" id="light-style">

</head>

<body class="authentication-bg pb-0" data-layout-config="{&quot;darkMode&quot;:false}">

<div class="auth-fluid">
    <!--Auth fluid left content -->
    <div class="auth-fluid-form-box">
        <div class="align-items-center d-flex h-100">
            <div class="card-body">

                <!-- Logo -->
                <div class="auth-brand text-center text-lg-left">
                    <a href="" class="logo-dark">
                        <span><img src="{{asset('img/logo.png')}}" alt="" height="75"></span>
                    </a>
                </div>

                <!-- title-->
                <h4 class="mt-0">Đăng ký tài khoản</h4>
                <p class="text-muted mb-4">Bạn không có tài khoản? Tạo tài khoản của bạn, chỉ mất chưa đầy một phút.</p>
                @if ($errors->any())


                        @foreach ($errors->all() as $error)
                            <p style="color: red">{{ $error }}</p>
                        @endforeach


                @endif
                <!-- form -->
                <form action="{{route('signup')}}">
                    <div class="form-group">
                        <label for="name">Họ tên</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Nhập họ tên" value="{{{old('name')}}}" >
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" id="email"  name="email" placeholder="Nhập email" value="{{{old('email')}}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input class="form-control" type="password"  name="password" id="password" placeholder="Nhập password" value="{{{old('password')}}}">
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-account-circle"></i> Đăng ký </button>
                    </div>
                    <!-- social-->
                    <div class="text-center mt-4">

                    </div>
                </form>
                <!-- end form-->

                <!-- Footer-->
                <footer class="footer footer-alt">
                    <p class="text-muted">Bạn đã có tài khoản?
                        <a href="{{route('login')}}" class="text-muted ml-1">
                            <b>Đăng nhập</b>
                        </a>
                    </p>
                </footer>

            </div> <!-- end .card-body -->
        </div> <!-- end .align-items-center.d-flex.h-100-->
    </div>
    <!-- end auth-fluid-form-box-->

    <!-- Auth fluid right content -->
    <div class="auth-fluid-right text-center">
        <div class="auth-user-testimonial">
            <h2 class="mb-3">{{config('app.name')}}</h2>
            <p class="lead"><i class="mdi mdi-format-quote-open"></i> Học tập là con đường dẫn đến thành công. <i
                    class="mdi mdi-format-quote-close"></i>
            </p>
            <p>
                {{config('app.name')}}
            </p>
        </div> <!-- end auth-user-testimonial-->
    </div>
    <!-- end Auth fluid right content -->
</div>
<!-- end auth-fluid-->

<script src="{{asset('js/vendor.min.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>


</body></html>
