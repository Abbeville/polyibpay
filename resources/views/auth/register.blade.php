@extends('auth.master')

@section('content')
    <div class="col-lg-6 col-12 p-0">
        <div class="card rounded-0 mb-0 p-2">
            <div class="card-header pt-50 pb-1">
                <div class="card-title">
                    <h4 class="mb-0">Create Account</h4>
                </div>
            </div>
            <p class="px-2">Fill the below form to create a new account.</p>
            <div class="card-content">
                <div class="card-body pt-0">
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


                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-label-group">
                            <input type="text" id="inputName" name="name" class="form-control" placeholder="Name" required>
                            <label for="inputName">Name</label>
                        </div>
                        <div class="form-label-group">
                            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required>
                            <label for="inputEmail">Email</label>
                        </div>
                        <div class="form-label-group">
                            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password"
                                   required>
                            <label for="inputPassword">Password</label>
                        </div>
                        <div class="form-label-group">
                            <input type="password" id="inputConfPassword" name="password_confirmation" class="form-control"
                                   placeholder="Confirm Password" required>
                            <label for="inputConfPassword">Confirm Password</label>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <fieldset class="checkbox">
                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                        <input type="checkbox" checked>
                                        <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                        <span class=""> I accept the terms & conditions.</span>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary float-left btn-inline mb-50">Login</a>
                        <button type="submit" class="btn btn-primary float-right btn-inline mb-50">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
