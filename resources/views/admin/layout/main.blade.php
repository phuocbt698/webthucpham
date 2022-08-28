<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | {{ $title ?? 'Dashboard' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('asset/admin') }}/favicon.ico" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('asset/admin') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/plugins/summernote/summernote-bs4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/plugins/toastr/toastr.min.css">
    <!-- jQuery -->
    <script src="{{ asset('asset/admin') }}/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('asset/admin') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('asset/admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('asset/admin') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="{{ asset('asset/admin') }}/plugins/toastr/toastr.min.js"></script>
    <!-- Ckediter -->
    <script src="{{ asset('asset') }}/ckeditor/ckeditor.js"></script>
    <!-- js Custom -->
    <script src="{{ asset('js') }}/ajax.js"></script>
    <script src="{{ asset('js') }}/toast.js"></script>
    <script src="{{ asset('js') }}/renderError.js"></script>
    <script src="{{ asset('js') }}/renderDataTable.js"></script>
    <script src="{{ asset('js') }}/callAddress.js"></script>
    <script src="{{ asset('js') }}/data.json"></script>
    <script src="{{ asset('js') }}/previewImage.js"></script>
    <script src="{{ asset('js') }}/createSlug.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- header -->
        @include('admin.layout.header')
        <!-- end-header -->

        <!-- sidebar -->
        @include('admin.layout.sidebar')
        <!-- end-sidebar -->

        <!-- content -->
        @yield('contents')
        <!-- end-content -->

        <!-- footer -->
        @include('admin.layout.footer')
        <!-- end-footer -->
    </div>
    <!-- ./wrapper -->

    <!-- overlayScrollbars -->
    <script src="{{ asset('asset/admin') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('asset/admin') }}/dist/js/adminlte.js"></script>
    

    <!-- File js -->
    @stack('jsFile')
    <!-- end-File js -->
    
</body>

</html>
