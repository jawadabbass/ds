<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ url('/admin/css/admin.css') }}">
    @stack('styles')
</head>

<body class="sidebar-mini control-sidebar-slide-open text-sm">
    <div class="wrapper">
        <!-- Navbar -->
        @include('admin.layouts.topbar')
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        @include('admin.layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        <!-- Main Footer -->
        @include('admin.layouts.footer')
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <!-- AdminLTE App -->
    <script src="{{ url('/admin/js/admin.js') }}"></script>
    @stack('scripts')
</body>

</html>
