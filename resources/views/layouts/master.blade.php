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
