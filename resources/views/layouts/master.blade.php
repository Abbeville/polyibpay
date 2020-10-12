<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.meta')
    <title>@yield('title')</title>

    <!-- Stylesheet File -->
    @include('partials.styles')
</head>

<body>

<!-- preloader area start -->
<div class="preloader" id="preloader">
    <div class="preloader-inner">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</div>
<!-- preloader area end -->


@guest
    <!-- header start -->
    <div class="header-area" style="background-image: url(assets/img/bg/1.png);">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-3">
                    <a class="menu-back-page" href="home.html">
                        <i class="fa fa-angle-left"></i>
                    </a>
                </div>
                <div class="col-sm-4 col-6 text-center">
                    <div class="page-name">Sign In</div>
                </div>
            </div>
        </div>
    </div>
@endguest

@auth

    <!-- header start -->
    <div class="header-area" style="background-color: #212529">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-3">
                    <div class="menu-bar">
                        <i class="fa fa-bars"></i>
                    </div>
                </div>
                <div class="col-sm-4 col-4 text-center">
                    <a href="home.html" class="logo">
                        <img src="https://dl3.pushbulletusercontent.com/qFRcjv77egmd4GkmwodM2Bp6BOjTCEba/billpay%2094x20-01.png" alt="logo">
                    </a>
                </div>
                <div class="col-sm-4 col-5 text-right">
                    <ul class="header-right">
                        <li>
                            <a href="#">
                                <i class="fa fa-envelope"></i>
                                <span class="badge">9</span>
                            </a>
                        </li>
                        <li>
                            <a href="notification.html">
                                <i class="fa fa-bell animated infinite swing"></i>
                                <span class="badge">6</span>
                            </a>
                        </li>
                        <li>
                            <a class="header-user" href="user-setting.html"><img src="assets/img/user.png"
                                                                                 alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- header end -->

@endauth


<!-- header end -->
@yield('contents')


@include('partials.footer')

<!-- back to top area start -->
<div class="back-to-top">
    <span class="back-top"><i class="fa fa-angle-up"></i></span>
</div>
<!-- back to top area end -->

@include('partials.scripts')
</body>

</html>
