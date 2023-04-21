<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->

    <!-- App css -->
    <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/app-creative.min.css')}}" rel="stylesheet" type="text/css" id="light-style">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/3.0.4/socket.io.js" integrity="sha512-aMGMvNYu8Ue4G+fHa359jcPb1u+ytAF+P2SCb+PxrjCdO3n3ZTxJ30zuH39rimUggmTwmh2u7wvQsDTHESnmfQ==" crossorigin="anonymous"></script>
    <script src="{{asset('tracking.js-master/build/tracking-min.js')}}"></script>
    <script src="{{asset('tracking.js-master/build/data/face-min.js')}}"></script>

@stack('css')

<body class="" data-layout="detached"
      data-layout-config="{&quot;layoutBoxed&quot;:false, &quot;leftSidebarCondensed&quot;:false, &quot;leftSidebarScrollable&quot;:false,&quot;darkMode&quot;:false, &quot;showRightSidebarOnStart&quot;: true}">
<!-- Topbar Start -->
@include('layout.topbar');
<!-- end Topbar -->

<!-- Start Content-->
<div class="container-fluid mm-active">

    <!-- Begin page -->
    <div class="wrapper mm-show">

        <!-- ========== Left Sidebar Start ========== -->
    @include('layout.sidebar')
    <!-- Left Sidebar End -->

        <div class="content-page">
            <div class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                @yield('breadcrum')

                            </div>
                            <h4 class="page-title">{{ $title ??"" }}</h4>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!-- end col -->
                    <div class="col-12">




                                @yield('content')


                    </div>
                    <!-- end col -->
                    <!-- end col -->

                    <!-- end col -->
                </div>

                <!-- Footer Start -->
            @include('layout.footter')
            <!-- end Footer -->

            </div> <!-- content-page -->

        </div> <!-- end wrapper-->
    </div>
    <!-- END Container -->


    <!-- Right Sidebar -->

    <!-- /Right-bar -->


    <!-- bundle -->

    <script src="{{asset('js/vendor.min.js')}}"></script>
    <script src="{{asset('js/app.min.js')}}"></script>


    <!-- Apex js -->
    <script src="assets/js/vendor/apexcharts.min.js"></script>

    <!-- Todo js -->
    <script src="assets/js/ui/component.todo.js"></script>

    <!-- demo app -->
    <script src="assets/js/pages/demo.dashboard-crm.js"></script>
    <!-- end demo js-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stack('js')

