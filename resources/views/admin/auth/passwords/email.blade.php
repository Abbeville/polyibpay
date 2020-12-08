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
                    <h1 class="h4 text-gray-900 mb-4"><b>ADMINISTRATOR FORGOT PASSWORD</b></h1>
                  </div>
                  
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="text-left col-lg-12" method="POST" action="{{ route('admin.password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                        <div class="form-group">
                            
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus aria-describedby="emailHelp" placeholder="Enter Email Address">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="text-center mb-4">
                            <button type="submit" class="btn btn-primary btn-block">Reset password</button>
                        </div>
                    </form>

                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="{{ route('admin.showLogin') }}">Back to Login Page</a>
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

