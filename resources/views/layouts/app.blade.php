<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {{-- Ionicons --}}
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{-- fontAwesome --}}
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!--Datatables-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">

    {{-- AdminLte --}}
    <link rel="stylesheet" href="{{url('/')}}/adminLTE/css/adminlte.min.css">
    {{-- <link rel="stylesheet" href="{{url('/')}}/adminLTE/css/all.min.css"> --}}
    <link rel="stylesheet" href="{{url('/')}}/adminLTE/css/OverlayScrollbars.min.css">
    {{-- <link rel="stylesheet" href="{{url('/')}}/adminLTE/css/tempusdominus-bootstrap-4.min.css"> --}}
    <link rel="stylesheet" href="{{url('/')}}/css/styles.css">
    {{-- fullcalendar --}}
    <link rel="stylesheet" href="/plugins/fullcalendar-5.10.1/lib/main.css">
    <link rel="icon" href="{{url('/')}}/adminLTE/img/logo.png">
</head>
<body class="hold-transition sidebar-mini layout-fixed tbl_scroll">
    <div class="wrapper">
        @include('layouts.components.navbar')
        @include('layouts.components.sidebar')
        <div class="content-wrapper" style="min-height: 543px;">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        @include('layouts.components.footer')
    </div>
  
    @include('sweetalert::alert')
    @yield('JS')
    {{-- FullCalendar --}}
    @yield('js-alert')
    @yield('js-calendar')
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="{{url('/')}}/js/jQuerySpanish.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/adminLTE/js/adminlte.js"></script>
    <script src="{{url('/')}}/adminLTE/js/jquery.overlayScrollbars.min.js"></script>
    <!--Datatables-->

    {{-- <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="{{url('/')}}/dataTable/dataTable.js"></script>
    {{-- Sweetalert2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('script_ventas')
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    
</body>
</html>