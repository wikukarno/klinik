<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="BootstrapDash">

    <title>@yield('title')</title>

    @stack('before-style')
    @include('includes.style')
    @stack('after-style')

</head>
<body>


<div class="">
    <div class="container">

            @yield('content')

    </div>
</div>



@stack('before-script')
@include('includes.script')
@stack('after-script')
</body>
</html>
