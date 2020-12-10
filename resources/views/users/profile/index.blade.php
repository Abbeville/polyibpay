@extends('layouts.master')

@section('contents')


    <div class="wrapper">

        <!-- header -->
    @include('partials.header')

    <!-- header ends -->

        <div class="container">
            <div class="p-1">
                <a href="{{ route('users.profile.edit') }}">
                    <button class="btn btn-primary btn-sm">Edit Profile</button>
                </a>
            </div>


            <h6 class="subtitle">My Details</h6>

            <div class="row">
                <div class="col-md-5 col-xs-12">
                    <div class="">
                        <div class="">
                            <div>
                                <p><b>{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</b></p>
                            </div>
                            <hr>
                            <div class="mt-4">
                                <h6>Bank Account Details</h6>
{{--                                <hr>--}}
                            </div>

                            <div class="p-1">
                                <table class="table table-active table-responsive">
                                    <tr>
                                        <td>Bank</td>
                                        <td>{{ getBankName($profile->bank_name_id) }}</td>
                                    </tr>

                                    <tr>
                                        <td>Account Name</td>
                                        <td>{{ $profile->bank_account_name }}</td>
                                    </tr>

                                    <tr>
                                        <td>Account Number</td>
                                        <td>{{ $profile->bank_account_number }}</td>
                                    </tr>

                                    <tr>
                                        <td>Account Type</td>
                                        <td>{{ $profile->bank_account_type }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="p-1">
                                <div class="mt-3">
                                    <h6>Crypto Wallets</h6>
                                    <hr>
                                </div>

                                <div>
                                    <table class="table table-responsive table-active">
                                        <tr>
                                            <td>BTC Wallet</td>
                                            <td>{{ $profile->btc_address  }}</td>
                                        </tr>

                                        <tr>
                                            <td>ETH Wallet</td>
                                            <td>{{ $profile->eth_address  }}</td>
                                        </tr>
                                    </table>
                                </div>


                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- footer-->
    @include('partials.footer')
    <!-- footer ends-->
    </div>
@endsection

