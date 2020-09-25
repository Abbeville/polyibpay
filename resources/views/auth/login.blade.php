@extends('auth.master')

@section('content')

    <div class="col-lg-6 col-12 p-0">
        <div class="card rounded-0 mb-0 px-2">
            <div class="card-header pb-1">
                <div class="card-title">
                    <h4 class="mb-0">Login</h4>
                </div>
            </div>
            <p class="px-2">Welcome back, please login to your account.</p>

            <div class="card-content">

                <div class="card-body pt-1">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-warning">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <fieldset class="form-label-group form-group position-relative has-icon-left">
                            <input type="text" class="form-control" id="user-name" placeholder="Email or Username"
                                   required>
                            <div class="form-control-position">
                                <i class="feather icon-user"></i>
                            </div>
                            <label for="user-name">Email or Username</label>
                        </fieldset>

                        <fieldset class="form-label-group position-relative has-icon-left">
                            <input type="password" class="form-control" id="user-password" placeholder="Password"
                                   required>
                            <div class="form-control-position">
                                <i class="feather icon-lock"></i>
                            </div>
                            <label for="user-password">Password</label>
                        </fieldset>
                        <div class="form-group d-flex justify-content-between align-items-center">
                            <div class="text-left">
                                <fieldset class="checkbox">
                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                        <input type="checkbox">
                                        <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                        <span class="">Remember me</span>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="text-right"><a href="{{ route('password.request') }}" class="card-link">Forgot
                                    Password?</a></div>
                        </div>
                        <a href="{{ route('register') }}"
                           class="btn btn-outline-primary float-left btn-inline">Register</a>
                        <button type="submit" class="btn btn-primary float-right btn-inline">Login</button>
                    </form>
                </div>
            </div>
            <div class="login-footer">
                <div class="divider">
                    <div class="divider-text">OR</div>
                </div>
                <div class="footer-btn d-inline">

                    <a href="#" class="btn btn-google"><span class="fa fa-google"></span></a>
                    <a href="#" class="btn btn-linkedin"><span class="fa fa-linkedin"></span></a>

                </div>
            </div>
        </div>
    </div>


@endsection
