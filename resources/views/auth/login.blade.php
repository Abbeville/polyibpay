@extends('layouts.master')

@section('contents')


    <!-- page-title stary -->
    <div class="page-title mg-top-50">
        <div class="container">
            <a class="float-left" href="home.html">Home</a>
            <span class="float-right">Sign In</span>
        </div>
    </div>
    <div class="ba-page-name text-center mg-bottom-40">
        <h3>Login</h3>
    </div>
    <!-- page-title end -->

    <!-- singin-area start -->
    <div class="signin-area">
        <div class="container">
            <form class="contact-form-inner" method="POST" action="{{ route('login') }}">
                @csrf
                <label class="single-input-wrap">
                    <span>User name or email address*</span>
                    <input type="text" name="email">
                </label>
                <label class="single-input-wrap">
                    <span>Password*</span>
                    <input type="password" name="password">
                </label>
                <div class="single-checkbox-wrap">
                    <input type="checkbox"><span>Remember password</span>
                </div>
                <a class="btn btn-purple" href="#">Login</a>
                <a class="forgot-btn" href="#">Forgot password?</a>
                <a class="forgot-btn" href="{{ route('register') }}">Create a New Account</a>
            </form>
        </div>
    </div>
    <!-- singin-area End -->



@endsection
