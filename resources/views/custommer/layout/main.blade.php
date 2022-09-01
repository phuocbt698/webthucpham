<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Food</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('asset/custommer')}}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('asset/custommer')}}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('asset/custommer')}}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{asset('asset/custommer')}}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{asset('asset/custommer')}}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('asset/custommer')}}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('asset/custommer')}}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('asset/custommer')}}/css/style.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset/slick-1.8.1') }}/slick/slick.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>

    @include('custommer.layout.header')

    @yield('contents')

    @include('custommer.layout.footer')

    <!-- Js Plugins -->
    <script src="{{asset('asset/custommer')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{asset('asset/custommer')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('asset/custommer')}}/js/jquery.nice-select.min.js"></script>
    <script src="{{asset('asset/custommer')}}/js/jquery-ui.min.js"></script>
    <script src="{{asset('asset/custommer')}}/js/jquery.slicknav.js"></script>
    <script src="{{asset('asset/custommer')}}/js/mixitup.min.js"></script>
    <script src="{{asset('asset/custommer')}}/js/owl.carousel.min.js"></script>
    <script src="{{asset('asset/custommer')}}/js/main.js"></script>
    <script src="{{ asset('asset/slick-1.8.1') }}/slick/slick.min.js"></script>
    @stack('jsFile')
</body>

</html>
