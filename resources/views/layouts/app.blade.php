<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="BootstrapDash">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    @stack('before-style')
    @include('includes.style')
    @stack('after-style')

</head>
<body>

@include('includes.sidebar')

<div class="container-fluid">
    <div class="main-content d-flex flex-column">
        @include('includes.header')

        <div class="main-content-container overflow-hidden">
            @yield('content')
        </div>

        <div class="flex-grow-1"></div>

        @include('includes.footer')
    </div>
</div>

@include('sweetalert::alert')
@stack('before-script')
@include('includes.script')
@stack('after-script')
</body>
</html>
