@extends('layouts.master')

@section('contents')


    <!-- page-title stary -->
    <div class="page-title mg-top-50">
        <div class="container">
            <a class="float-left" href="{{ route('home') }}">Home</a>
            <span class="float-right">Sign Up</span>
        </div>
    </div>
    <div class="ba-page-name text-center mg-bottom-40">
        <h3>Sign Up</h3>
    </div>
    <!-- page-title end -->

    <!-- singin-area start -->
    <div class="signin-area">
        <div class="container">

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



            <form class="contact-form-inner" method="post" action="{{ route('register') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class=" text-gray-600" for="leadCapFirstName">
                            First Name
                        </label>
                        <input name="firstname" class="form-control rounded-pill " id="firstname" type="text"
                               value="{{ old('firstname') }}" autofocus="" required=""/>
                        @if ($errors->has('firstname'))
                            <span class="invalida" role="alert">
                                                <strong>{{ $errors->first('firstname') }}</strong>
                                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label class=" text-gray-600" for="leadCapLastName">
                            Last Name <span class="text-danger">*</span>
                        </label>
                        <input name="lastname" class="form-control rounded-pill" id="lastname" type="text"
                               value="{{ old('lastname') }}" required=""/>

                        @if ($errors->has('lastname'))
                            <span class="invalida" role="alert">
                                                <strong>{{ $errors->first('lastname') }}</strong>
                                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class=" text-gray-600" for="email">Email address <span class="text-danger">*</span></label>
                    <input name="email" class="form-control rounded-pill" id="email" type="email"
                           value="{{ old('email') }} " required=""/>
                    @if ($errors->has('email'))
                        <span class="invalida" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label class=" text-gray-600" for="phone">Phone Number <span class="text-danger">*</span></label>
                    <input name="phone_number" class="form-control rounded-pill" id="phone" type="phone"
                           value="{{ old('phone') }} " required=""/>
                    @if ($errors->has('phone'))
                        <span class="invalida" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                    @endif
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class=" text-gray-600" for="password">Password <span class="text-danger">*</span></label>
                        <input name="password" class="form-control rounded-pill" id="password" type="password"
                               required=""/>
                        @if ($errors->has('password'))
                            <span class="invalida" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-gray-600" for="confirm-password">Confirm Password <span class="text-danger">*</span></label>
                        <input name="password_confirmation" class="form-control rounded-pill" id="confirm-password"
                               type="password" required=""/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="text-gray-600" for="referral">Referred By (User ID)</label>
                        <input name="referral" class="form-control rounded-pill" id="referral" type="text"
                               />
                    </div>
                </div>

                <button class="btn btn-purple" type="submit">CREATE AN ACCOUNT</button>
                <a class="forgot-btn" href="{{ route('password.request') }}">Forgot password?</a>
                <a class="forgot-btn" href="{{ route('login') }}">Login</a>
            </form>
        </div>
    </div>
    <!-- singin-area End -->



@endsection
