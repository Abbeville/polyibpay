@extends('admin.layout.master')

@section('page_title', 'Administrator Login')

@section('more_css')
{{-- More CSS here --}}

@endsection

@section('content')

  <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <img src="{{ asset('assets/img/logo-login.png') }}" alt="logo" class="logo-small">

                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><b>ADMINISTRATOR LOGIN</b></h1>
                  </div>
                  
                  <form method="POST" action="{{ route('admin.login') }}" class="user">

                    @csrf
                    <div class="form-group">
                       <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus aria-describedby="emailHelp"
                        placeholder="Enter Email Address">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <button class="btn btn-primary btn-block" type="submit">Login</button>
                    </div>
                  </form>

                  <hr>

                  <div class="text-center">
                    <a class="font-weight-bold small" href="{{ route('admin.password.reset') }}">Forgot Password</a>
                  </div>

                </div>
                  
                  <p style="font-size: 10px; text-align: right;padding-right: 20px;" >
                    <em>All Right Reserved {{ date('Y') }}</em>
                  </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection


@section('more_scripts')
{{-- More Scripts here --}}
@endsection
