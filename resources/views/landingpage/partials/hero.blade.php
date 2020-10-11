<header class="page-header page-header-dark bg-img-repeat bg-secondary"
        style='background-image: url("{{ asset('landingpage/assets/img/music_concert-wallpaper-3554x1999.jpg') }}"); background-size: cover;'>
    <div class="page-header-content">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">

                    <h1 class="page-header-title text-dark">Become the next African Music Star.</h1>
                    <p class="page-header-text text-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
                <div class="col-lg-6">
                    <div class="card rounded-lg text-dark">
                        <div class="card-header py-4">Join the Community</div>
                        <div class="card-body">
                            <form method="POST" action="">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="small text-gray-600" for="leadCapFirstName">
                                            First Name
                                        </label>
                                        <input name="firstname" class="form-control rounded-pill " id="firstname" type="text" value="{{ old('firstname') }}" autofocus="" required="" />
                                        @if ($errors->has('firstname'))
                                            <span class="invalida" role="alert">
                                                <strong>{{ $errors->first('firstname') }}</strong>
                                            </span>
                                        @endif
                                        
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="small text-gray-600" for="leadCapLastName">
                                            Last Name
                                        </label>
                                        <input name="lastname" class="form-control rounded-pill" id="lastname" type="text" value="{{ old('lastname') }}" required="" />
                                        
                                        @if ($errors->has('lastname'))
                                            <span class="invalida" role="alert">
                                                <strong>{{ $errors->first('lastname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="small text-gray-600" for="email">Email address</label>
                                    <input name="email" class="form-control rounded-pill" id="email" type="email" value="{{ old('email') }} " required="" />
                                    @if ($errors->has('email'))
                                        <span class="invalida" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <button class="btn btn-primary btn-marketing btn-block rounded-pill mt-4" type="submit">
                                   Get Started
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="svg-border-angled text-white">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" fill="currentColor">
            <polygon points="0,100 100,0 100,100"/>
        </svg>
    </div>
</header>
