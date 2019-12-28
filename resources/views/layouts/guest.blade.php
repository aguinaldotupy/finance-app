<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.inc.header')
<body class="hold-transition login-page">
@yield('content')
@include('layouts.inc.script')
</body>
</html>
