<nav class="navbar navbar-marketing navbar-expand-lg bg-white navbar-light">
    <div class="container">

        <div class="avatar avatar-xxl">
            <img class="avatar-img img-fluid" src="{{ asset('landingpage/assets/img/logo.svg') }}" alt="">
        </div>
        &nbsp;
        <a class="navbar-brand text-dark" href="index.html">
            Afrinolly Incubation Hub
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                    data-feather="menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mr-lg-5">
                <li class="nav-item"><a class="nav-link" href="index.html">Home </a></li>
                <li class="nav-item"><a class="nav-link" href="#.">About Us </a></li>
                <li class="nav-item"><a class="nav-link" href="#.">Contact Us </a></li>
                <li class="nav-item"><a class="nav-link" href="#.">Afrinolly.com </a></li>


            </ul>
            <a class="btn-primary btn rounded-pill px-4 ml-lg-4" href="{{ route('login') }}">Sign
                In<i class="fas fa-arrow-right ml-1"></i></a>
        </div>
    </div>
</nav>
