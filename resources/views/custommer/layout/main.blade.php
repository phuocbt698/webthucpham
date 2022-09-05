<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset($config->logo) }}" />
    <title>Ogani Food {{empty($title) ? '' : "| $title"}}</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('asset/custommer') }}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset/custommer') }}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset/custommer') }}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset/custommer') }}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset/custommer') }}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset/custommer') }}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset/custommer') }}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset/custommer') }}/css/style.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset/slick-1.8.1') }}/slick/slick.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset/login') }}/css-login.css" type="text/css">
    <script src="{{ asset('js') }}/callAddress.js"></script>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <div class="modal-login">
        <div id="modal" class="popupContainer" style="display: none;">
            <header class="popupHeader">
                <span class="header_title">Login</span>
                <span class="modal_close"><i class="fa fa-times"></i></span>
            </header>

            <section class="popupBody">
                <!-- Social Login -->
                <div class="social_login">
                    <div class="">
                        <a href="#" class="social_box fb">
                            <span class="icon"><i class="fa fa-facebook"></i></span>
                            <span class="icon_title">Connect with Facebook</span>

                        </a>

                        <a href="#" class="social_box google">
                            <span class="icon"><i class="fa fa-google-plus"></i></span>
                            <span class="icon_title">Connect with Google</span>
                        </a>
                    </div>

                    <div class="centeredText">
                        <span>Or use your Email address</span>
                    </div>

                    <div class="action_btns">
                        <div class="one_half"><a href="#" id="login_form" class="btn">Login</a></div>
                        <div class="one_half last"><a href="#" id="register_form" class="btn">Sign up</a></div>
                    </div>
                </div>

                <!-- Username & Password Login form -->
                <div class="user_login">
                    <form>
                        <label>Email / Username</label>
                        <input type="text" />
                        <br />

                        <label>Password</label>
                        <input type="password" />
                        <br />

                        <div class="checkbox">
                            <input id="remember" type="checkbox" />
                            <label for="remember">Remember me on this computer</label>
                        </div>

                        <div class="action_btns">
                            <div class="one_half"><a href="#" class="btn back_btn"><i
                                        class="fa fa-angle-double-left"></i> Back</a></div>
                            <div class="one_half last"><a href="#" class="btn btn_red">Login</a></div>
                        </div>
                    </form>

                    <a href="#" class="forgot_password">Forgot password?</a>
                </div>

                <!-- Register Form -->
                <div class="user_register">
                    <form>
                        <label>Full Name</label>
                        <input type="text" />
                        <br />

                        <label>Email Address</label>
                        <input type="email" />
                        <br />

                        <label>Password</label>
                        <input type="password" />
                        <br />

                        <div class="checkbox">
                            <input id="send_updates" type="checkbox" />
                            <label for="send_updates">Send me occasional email updates</label>
                        </div>

                        <div class="action_btns">
                            <div class="one_half"><a href="#" class="btn1 back_btn"><i
                                        class="fa fa-angle-double-left"></i> Back</a></div>
                            <div class="one_half last"><a href="#" class="btn1 btn_red">Register</a></div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>

    @include('custommer.layout.header')

    @yield('contents')

    @include('custommer.layout.footer')

    <!-- Js Plugins -->
    <script src="{{ asset('asset/custommer') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('asset/custommer') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('asset/custommer') }}/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('asset/custommer') }}/js/jquery-ui.min.js"></script>
    <script src="{{ asset('asset/custommer') }}/js/jquery.slicknav.js"></script>
    <script src="{{ asset('asset/custommer') }}/js/mixitup.min.js"></script>
    <script src="{{ asset('asset/custommer') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('asset/custommer') }}/js/main.js"></script>
    <script src="{{ asset('asset/slick-1.8.1') }}/slick/slick.min.js"></script>
    <script src="{{ asset('asset/login') }}/login-js.js"></script>
    <script src="{{ asset('asset/login') }}/jquery.leanModal.min.js"></script>
    <script>
        $("#modal_trigger").leanModal({
            top: 100,
            overlay: 0.6,
            closeButton: ".modal_close"
        });

        $(function() {
            // Calling Login Form
            $("#login_form").click(function() {
                $(".social_login").hide();
                $(".user_login").show();
                return false;
            });

            // Calling Register Form
            $("#register_form").click(function() {
                $(".social_login").hide();
                $(".user_register").show();
                $(".header_title").text('Register');
                return false;
            });

            // Going back to Social Forms
            $(".back_btn").click(function() {
                $(".user_login").hide();
                $(".user_register").hide();
                $(".social_login").show();
                $(".header_title").text('Login');
                return false;
            });
        });
    </script>
    <script>
        getFullAddress('addressWeb', '{{$config->address}}', {{$config->ward_id}}, {{$config->district_id}}, {{$config->city_id}})
    </script>
    @stack('jsFile')
</body>

</html>
