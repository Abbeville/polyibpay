@extends('layouts.master')

@section('contents')


    <div class="wrapper walletpage">
        <!-- header -->
    @include('partials.header')
    <!-- header ends -->

        <div class="container">
            <div class="row mt-4">
                <div class="col">


                </div>

                <div class="col-auto">
                    <button class="btn btn-default " data-toggle="modal" data-target="#addmoney"><i
                                class="material-icons">add</i> New Card
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col">


                </div>

            </div>
        </div>

        <div class="swiper-container card-slide mb-2">
            <div class="swiper-wrapper">

                <div class="swiper-slide pb-4">
                    <div class="container z-1 position-relative">
                        <div class="card bg-template shadow mt-4 h-200">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <img src="{{ asset('assets/img/visa-logos.png') }}" alt="">
                                        <h4 class="mt-1 font-weight-normal">$ 1548.00</h4>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <h3 class="font-weight-normal">**** **** **** 9858</h3>
                                    </div>
                                    <div class="col-12">
                                        <p>Ammy Jahnson <span class="float-right">11/20</span></p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="row bottom-15">
                        <div class="swiper-container icon-slide mb-4 swiper-container-horizontal">
                            <div class="swiper-wrapper">
                                <a href="#" class="swiper-slide text-center">
                                    <div class="avatar avatar-60 no-shadow border-0">
                                        <div class="overlay gradient-danger"></div>
                                        <i class="material-icons text-danger">list</i>
                                    </div>
                                    <p class="small mt-2">Details</p>
                                </a>
                                <a href="#" class="swiper-slide text-center">
                                    <div class="avatar avatar-60 no-shadow border-0">
                                        <div class="overlay gradient-info"></div>
                                        <i class="material-icons text-info">add_circle_outline
                                        </i>
                                    </div>
                                    <p class="small mt-2">Fund</p>
                                </a>
                                <a href="#" class="swiper-slide text-center">
                                    <div class="avatar avatar-60 no-shadow border-0">
                                        <div class="overlay gradient-primary"></div>
                                        <i class="material-icons text-primary">remove_circle_outline</i>
                                    </div>
                                    <p class="small mt-2">Withdraw</p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="container z-0">

                        <div class="card mb-4 shadow">

                            <div class="card-body border-bottom">
                                <div class="row">
                                    <div class="col">
                                        <p>EMI<br><small class="text-mute text-secondary">Car Loan</small></p>
                                    </div>
                                    <div class="col text-right">
                                        <p>$ 658.00<br><small class="text-mute text-secondary">Paid: 18-12-2019</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-bottom">
                                <div class="row">
                                    <div class="col">
                                        <p>EMI<br><small class="text-mute text-secondary">Car Loan</small></p>
                                    </div>
                                    <div class="col text-right">
                                        <p>$ 658.00<br><small class="text-mute text-secondary">Paid: 18-12-2019</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide pb-4">
                    <div class="container z-1 position-relative">
                        <div class="card gradient-success  text-white shadow mt-4 h-200">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <img src="img/visa-logos.png" alt="">
                                        <p class="small text-mute mt-2">Debit Card</p>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <h3 class="font-weight-normal">**** **** **** 9858</h3>
                                    </div>
                                    <div class="col-12">
                                        <p>Ammy Jahnson <span class="float-right">11/20</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container top-50 z-0">
                        <div class="card mb-4 shadow pt-5">
                            <div class="card-body border-bottom">
                                <div class="row">
                                    <div class="col">
                                        <p>EMI<br><small class="text-mute text-secondary">Car Loan</small></p>
                                    </div>
                                    <div class="col text-right">
                                        <p>$ 658.00<br><small class="text-mute text-secondary">Paid: 18-12-2019</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-bottom">
                                <div class="row">
                                    <div class="col">
                                        <p>EMI<br><small class="text-mute text-secondary">Car Loan</small></p>
                                    </div>
                                    <div class="col text-right">
                                        <p>$ 658.00<br><small class="text-mute text-secondary">Paid: 18-12-2019</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-none">
                                <button class="btn btn-default shadow  btn-rounded btn-block btn-lg ">Make Payment
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide pb-4">
                    <div class="container z-1 position-relative">
                        <div class="card gradient-danger text-white shadow mt-4 h-200">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <img src="img/visa-logos.png" alt="">
                                        <p class="small text-mute mt-2">Debit Card</p>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <h3 class="font-weight-normal">**** **** **** 9858</h3>
                                    </div>
                                    <div class="col-12">
                                        <p>Ammy Jahnson <span class="float-right">11/20</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container top-50 z-0">
                        <div class="card mb-4 shadow pt-5">
                            <div class="card-body border-bottom">
                                <div class="row">
                                    <div class="col">
                                        <p>EMI<br><small class="text-mute text-secondary">Car Loan</small></p>
                                    </div>
                                    <div class="col text-right">
                                        <p>$ 658.00<br><small class="text-mute text-secondary">Paid: 18-12-2019</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-bottom">
                                <div class="row">
                                    <div class="col">
                                        <p>EMI<br><small class="text-mute text-secondary">Car Loan</small></p>
                                    </div>
                                    <div class="col text-right">
                                        <p>$ 658.00<br><small class="text-mute text-secondary">Paid: 18-12-2019</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-none">
                                <button class="btn btn-default shadow  btn-rounded btn-block btn-lg ">Make Payment
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="swiper-pagination"></div>

        </div>


        <!-- footer-->
    @include('partials.footer')
    <!-- footer ends-->
    </div>
@endsection


@section('scripts')



@endsection
