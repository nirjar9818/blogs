<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sensive Blog - Home</title>
    <link rel="icon" href="{{asset('frontend/img/Fevicon.png')}}" type="image/png">

    <link rel="stylesheet" href="{{asset('frontend/vendors/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/vendors/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/vendors/themify-icons/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/vendors/linericon/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/vendors/owl-carousel/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/vendors/owl-carousel/owl.carousel.min.css')}}">

    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    @stack('header')
</head>
<body>
<!--================Header Menu Area =================-->
@include('layouts.frontend.partials.navbar')
<!--================Header Menu Area =================-->

<main class="site-main">
  @yield('content')

</main>

<!--================ Start Footer Area =================-->
@include('layouts.frontend.partials.footer')
<!--================ End Footer Area =================-->

<script src="{{asset('frontend/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('frontend/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontend/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('frontend/js/mail-script.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
@stack('footer')
</body>
</html>
