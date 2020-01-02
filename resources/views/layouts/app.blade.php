<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.inc.header')
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
    <div class="wrapper" id="app">
        <nav-bar></nav-bar>
        <side-bar></side-bar>
        <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content-header')
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div><!-- /.container-fluid -->
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
        <app-footer></app-footer>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside><!-- /.control-sidebar -->
    </div>
@include('layouts.inc.script')
</body>
</html>
