@extends('layouts.master')

@section('contents')


    <div class="wrapper">

        <!-- header -->
    @include('partials.header')

    <!-- header ends -->

        <div class="container">
            <div class="row mt-3">
                <div class="col-12 px-0">
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item">
                            <a href="{{ route('users.profile.edit') }}" class="row">
                                <div class="col">
                                    <h6 class="text-dark mb-1">Edit Profile</h6>
                                    <p class="text-secondary mb-0 small">Update your personal information</p>
                                </div>
                                <div class="col-2 pl-0 align-self-center text-right">
                                    <i class="material-icons text-secondary">chevron_right</i>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('users.settings.password') }}" class="row">
                                <div class="col">
                                    <h6 class="text-dark mb-1">Change password</h6>
                                    <p class="text-secondary mb-0 small">Change your password to a new one</p>
                                </div>
                                <div class="col-2 pl-0 align-self-center text-right">
                                    <i class="material-icons text-secondary">chevron_right</i>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('users.settings.pin') }}" class="row">
                                <div class="col">
                                    <h6 class="text-dark mb-1">Transaction Pin</h6>
                                    <p class="text-secondary mb-0 small">Set or update your 4 digit transaction pin</p>
                                </div>
                                <div class="col-2 pl-0 align-self-center text-right">
                                    <i class="material-icons text-secondary">chevron_right</i>
                                </div>
                            </a>
                        </li>

{{--                        <li class="list-group-item">--}}
{{--                            <a href="{{ route('users.settings.bank') }}" class="row">--}}
{{--                                <div class="col">--}}
{{--                                    <h6 class="text-dark mb-1">Withdrawal Settings</h6>--}}
{{--                                    <p class="text-secondary mb-0 small">Change or set your bank account</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-2 pl-0 align-self-center text-right">--}}
{{--                                    <i class="material-icons text-secondary">chevron_right</i>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </div>
            </div>

        </div>
        <!-- footer-->
    @include('partials.footer')
    <!-- footer ends-->
    </div>
@endsection
