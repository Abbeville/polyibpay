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
                            <a href="{{ route('users.transactions.crypto-request') }}" class="row">
                                <div class="col">
                                    <h6 class="text-dark mb-1">Sell Bitcoin</h6>
                                    <p class="text-secondary mb-0 small">Request To Exchange Bitcoin for Naira</p>
                                </div>
                                <div class="col-2 pl-0 align-self-center text-right">
                                    <i class="material-icons text-secondary">chevron_right</i>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('users.transactions.crypto-transactions') }}" class="row">
                                <div class="col">
                                    <h6 class="text-dark mb-1">Transactions</h6>
                                    <p class="text-secondary mb-0 small">View your Bitcoin Transactions</p>
                                </div>
                                <div class="col-2 pl-0 align-self-center text-right">
                                    <i class="material-icons text-secondary">chevron_right</i>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
        <!-- footer-->
    @include('partials.footer')
    <!-- footer ends-->
    </div>
@endsection
