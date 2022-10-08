<html lang="en"><head>
    <meta charset="utf-8">
    <title>Detached | Hyper - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->

    <!-- App css -->
    <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/app-creative.min.css')}}" rel="stylesheet" type="text/css"  id="light-style">

@stack('css')

<body class="" data-layout="detached" data-layout-config="{&quot;layoutBoxed&quot;:false, &quot;leftSidebarCondensed&quot;:false, &quot;leftSidebarScrollable&quot;:false,&quot;darkMode&quot;:false, &quot;showRightSidebarOnStart&quot;: true}">
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
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <!-- end col-->

                                @yield('content')
                                    <!-- end col-->
                                </div>
                                <!-- end row -->

                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
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
<div class="right-bar">

    <div class="rightbar-title">
        <a href="javascript:void(0);" class="right-bar-toggle float-right">
            <i class="dripicons-cross noti-icon"></i>
        </a>
        <h5 class="m-0">Settings</h5>
    </div>

    <div class="rightbar-content h-100" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer">

                </div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden;">
                        <div class="simplebar-content" style="padding: 0px;">

                            <div class="p-3">
                                <div class="alert alert-warning" role="alert">
                                    <strong>Customize </strong> the overall color scheme, layout width, etc.
                                </div>

                                <!-- Settings -->
                                <h5 class="mt-3">Color Scheme</h5>
                                <hr class="mt-1">

                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="color-scheme-mode" value="light" id="light-mode-check" checked="">
                                    <label class="custom-control-label" for="light-mode-check">Light Mode</label>
                                </div>

                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="color-scheme-mode" value="dark" id="dark-mode-check">
                                    <label class="custom-control-label" for="dark-mode-check">Dark Mode</label>
                                </div>

                                <!-- Width -->
                                <h5 class="mt-4">Width</h5>
                                <hr class="mt-1">
                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="width" value="fluid" id="fluid-check" checked="">
                                    <label class="custom-control-label" for="fluid-check">Fluid</label>
                                </div>
                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="width" value="boxed" id="boxed-check">
                                    <label class="custom-control-label" for="boxed-check">Boxed</label>
                                </div>



                                <button class="btn btn-primary btn-block mt-4" id="resetBtn">Reset to Default</button>

                                <a href="https://themes.getbootstrap.com/product/hyper-responsive-admin-dashboard-template/" class="btn btn-danger btn-block mt-3" target="_blank"><i class="mdi mdi-basket mr-1"></i> Purchase Now</a>
                            </div> <!-- end padding-->

                        </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 499px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="height: 0px; display: none;"></div></div></div>
</div>

<div class="rightbar-overlay"></div>
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

