<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Log In | {{config('app.name')}}</title>
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
                <div class="auth-brand text-center ">
                    <a href="" class="logo-dark">
                        <span><img src="{{asset('img/logo.png')}}" alt="" height="75"></span>
                    </a>

                </div>

                <!-- title-->
                <h4 class="mt-0">Đăng nhập</h4>
                <p class="text-muted mb-4">Nhập địa chỉ tài khoản và mật khẩu của bạn để truy cập tài khoản.</p>

                <!-- form -->
                <form action="{{route('signin')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="emailaddress">Tài khoản</label>
                        <input class="form-control" type="text" id="emailaddress"  name="email"
                               placeholder="Nhập tài khoản của bạn" value="{{old('email')}}">
                    </div>
                    <div class="form-group">

                        <label for="password">Mật khẩu</label>
                        <input class="form-control" type="password" id="password"
                               placeholder="Nhập mật khẩu của bạn" name="password" value="{{old('password')}}">
                    </div>

                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-login"></i> Đăng nhập
                        </button>
                    </div>
                    <!-- social-->
                    <div class="text-center mt-4">
{{--                        <p class="text-muted font-16">Đăng nhập với</p>--}}
{{--                        <ul class="social-list list-inline mt-3">--}}
{{--                            <li class="list-inline-item">--}}
{{--                                <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i--}}
{{--                                        class="mdi mdi-facebook"></i></a>--}}
{{--                            </li>--}}
{{--                            <li class="list-inline-item">--}}
{{--                                <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i--}}
{{--                                        class="mdi mdi-google"></i></a>--}}
{{--                            </li>--}}
{{--                            <li class="list-inline-item">--}}
{{--                                <a href="javascript: void(0);" class="social-list-item border-info text-info"><i--}}
{{--                                        class="mdi mdi-twitter"></i></a>--}}
{{--                            </li>--}}
{{--                            <li class="list-inline-item">--}}
{{--                                <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i--}}
{{--                                        class="mdi mdi-github-circle"></i></a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
                    </div>
                </form>
                <!-- end form-->

                <!-- Footer-->
                <footer class="footer footer-alt">
                    <p class="text-muted">Bạn chưa có tài khoản?
                        <a href="{{route('register')}}" class="text-muted ml-1">
                            <b>Đăng ký</b>
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

<!-- bundle -->

<script src="{{asset('js/vendor.min.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>


</body>
</html>
