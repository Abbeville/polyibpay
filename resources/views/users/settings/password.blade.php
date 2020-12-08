@extends('layouts.master')

@section('contents')


    <div class="wrapper">

        <!-- header -->
    @include('partials.header')

    <!-- header ends -->

        <div class="container">

            <h6 class="subtitle">Change Password</h6>
            <form action="{{ route('user.password.update') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        @if(Session::has('error'))
                            <div class="alert alert-warning">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <div class="form-group float-label active">
                            <input type="password" class="form-control" name="current-password" value="{{ old('current-password') }}">
                            <label class="form-control-label">Current Password</label>

                            <small class="text-small text-danger">
                                @error('current-password')
                                {{ $message }}
                                @enderror
                            </small>

                        </div>

                        <div class="form-group float-label active">
                            <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                            <label class="form-control-label">New Password</label>
                            <small class="text-small text-danger">
                                @error('password')
                                {{ $message }}
                                @enderror
                            </small>
                        </div>

                        <div class="form-group float-label active">
                            <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
                            <label class="form-control-label">Confirm Password</label>
                            <small class="text-small text-danger">
                                @error('password_confirmation')
                                {{ $message }}
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <hr>
                        <button type="submit" class="btn btn-lg btn-default text-white btn-block btn-rounded shadow mt-50">Submit</button>
                    </div>
                </div>
            </form>



        </div>

        <!-- footer-->
    @include('partials.footer')
    <!-- footer ends-->
    </div>
@endsection
