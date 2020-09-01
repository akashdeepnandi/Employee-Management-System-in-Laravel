<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ Session::token() }}"> 
        <title>EAMS | Dashboard</title>
        {{-- favicon --}}
        <link rel="icon" href="/img/partner.png">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="/plugins/fontawesome-free/css/all.min.css"
        />
        <!-- Ionicons -->
        <link
            rel="stylesheet"
            href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"
        />
        {{-- Font awesome 4.7 --}}
        <link rel="stylesheet" href="/dist/css/font-awesome.min.css">
        <!-- Tempusdominus Bbootstrap 4 -->
        
        <!-- Theme style -->
        <link rel="stylesheet" href="/dist/css/adminlte.min.css" />
        <!-- overlayScrollbars -->
        <link
            rel="stylesheet"
            href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"
        />
        
        <!-- summernote -->
        <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.css" />
        <!-- Google Font: Source Sans Pro -->
        <link
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700"
            rel="stylesheet"
        />
    <!-- DataTables -->
    <link
    rel="stylesheet"
    href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"
    />
    <link
    rel="stylesheet"
    href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"
    />
    <!-- daterange picker -->
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    {{-- <link rel="stylesheet" href="/css/daterangepicker.css"> --}}
    <style>
        .hide-input {
            display: none;
        }
        .proftable tr td:first-child {
            font-weight: bold;
            color: rgb(11, 72, 138);
        }
    </style>
    </head>
        @guest

        <body class="hold-transition login-page">
            {{-- If user is not logged in --}}
            @yield('content')

        @else
        @if (Route::currentRouteName() == 'password.request' || Route::currentRouteName() == 'password.reset' || Route::currentRouteName() == 'password.confirm')
        <body class="hold-transition login-page">
            {{-- If user is not logged in --}}
            @yield('content')
        @else
        <body class="hold-transition sidebar-mini layout-fixed">

            <div class="wrapper">
                {{-- navbar include --}}
                @include('includes.navbar')
                @include('includes.main_sidebar')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                @yield('content')
                </div>
                <footer class="main-footer">
                    <strong
                        >Copyright &copy; 2014-2019
                        <a href="http://adminlte.io">AdminLTE.io</a>.</strong
                    >
                    All rights reserved.
                    <div class="float-right d-none d-sm-inline-block">
                        <b>Version</b> 3.0.5
                    </div>
                </footer>
                <!-- Control Sidebar -->
                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Control sidebar content goes here -->
                </aside>
                <!-- /.control-sidebar -->
            </div>
            <!-- ./wrapper -->
        @endif
        
        @endguest
        

        <!-- jQuery -->
        <script src="/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge("uibutton", $.ui.button);
        </script>
        <!-- Bootstrap 4 -->
        <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        
        <!-- Summernote -->
        <script src="/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/dist/js/adminlte.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        {{-- <script src="/dist/js/pages/dashboard.js"></script> --}}
        {{-- font awesome --}}
        {{-- <script src="https://use.fontawesome.com/2d4c4e3d51.js"></script> --}}
        <!-- AdminLTE for demo purposes -->
        <script src="/dist/js/demo.js"></script>
        <!-- DataTables -->
        <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <!-- InputMask -->
        <script src="/plugins/moment/moment.min.js"></script>
        <script src="/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
        <!-- date-range-picker -->
        <script src="/plugins/daterangepicker/daterangepicker.js"></script>
        {{-- <script src="/js/daterangepicker.js"></script> --}}
        {{-- <script src="/js/moment.min.js"></script> --}}
        @yield('extra-js')
    </body>
</html>
