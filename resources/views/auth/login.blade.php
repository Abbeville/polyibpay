@extends('layouts.master')
@section('title','Login - Billspay')
@section('contents')


    <div class="wrapper">
        <!-- header -->
        <div class="header">
            <div class="row no-gutters">
                <div class="col-auto">
                    <a href="{{ route('home') }}" class="btn  btn-link text-dark"><i
                                class="material-icons">chevron_left</i></a>
                </div>
                <div class="col text-center"></div>
                <div class="col-auto">
                </div>
            </div>
        </div>
        <!-- header ends -->

        <div class="row no-gutters login-row">
            <div class="col align-self-center px-3 text-center">
                <br>

                    <img src="{{ asset('assets/img/bp3.png') }}" alt="logo" class="logo-small" style="height: 122px; width: 100px;">



                <form class="form-signin mt-3 " action="{{ route('login') }}" method="POST">
                    @csrf

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
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <div class="form-group">
                        <input type="text" id="inputEmail" class="form-control form-control-lg text-center"
                               placeholder="Phone or Email Address" name="email" required autofocus>
                    </div>

                    <div class="form-group">
                        <input type="password" id="inputPassword" class="form-control form-control-lg text-center"
                               placeholder="Password" name="password" required>
                    </div>

                    <div class="form-group my-4 text-left">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberme">
                            <label class="custom-control-label" for="rememberme">Remember Me</label>
                        </div>
                    </div>


                    <button class="btn btn-default btn-lg btn-rounded shadow btn-block mb-2" type="submit">Login </button>
                        <a href="{{ route('password.request') }}" class="mt-4 d-block">Forgot Password?</a>
                        <a href="{{ route('register') }}" class="mt-4 d-block">Create a new Account</a>


                </form>
            </div>
        </div>


    </div>



@endsection
