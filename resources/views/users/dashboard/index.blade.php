@extends('layouts.master')

@section('contents')


    <div class="wrapper homepage">

        <!-- header -->
    @include('partials.header')


    <!-- header ends -->

        <div class="container">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="card bg-template shadow mt-4 h-190">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <figure class="avatar avatar-60"><img
                                        src="https://ui-avatars.com/api/?name={{ auth()->user()->firstname.'+'.auth()->user()->lastname }}"
                                        alt=""></figure>
                        </div>
                        <div class="col pl-0 align-self-center">
                            <h5 class="mb-1">{{  auth()->user()->firstname.' '.auth()->user()->lastname }}</h5>
                            <p class="text-mute small">Good morning</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container top-100">
            <div class="card mb-4 shadow">
                <div class="card-body border-bottom">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-0 font-weight-normal"> ₦ 0</h3>
                            <p class="text-mute">My Balance</p>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-default btn-rounded-54 shadow" data-toggle="modal"
                                    data-target="#addmoney"><i class="material-icons">add</i></button>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-none">

                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="swiper-container icon-slide mb-4">
                    <div class="swiper-wrapper">
                        <a href="#" class="swiper-slide text-center" data-toggle="modal" data-target="#paymodal">
                            <div class="avatar avatar-60 no-shadow border-0">
                                <div class="overlay bg-template"></div>
                                <i class="material-icons text-template">phone</i>
                            </div>
                            <p class="small mt-2">Airtime</p>
                        </a>
                        <a href="#" class="swiper-slide text-center" data-toggle="modal" data-target="#sendmoney">
                            <div class="avatar avatar-60 no-shadow border-0">
                                <div class="overlay bg-template"></div>
                                <i class="material-icons text-template">language</i>
                            </div>
                            <p class="small mt-2">Data</p>
                        </a>
                        <a href="#" class="swiper-slide text-center" data-toggle="modal" data-target="#bookmodal">
                            <div class="avatar avatar-60 no-shadow border-0">
                                <div class="overlay bg-template"></div>
                                <i class="material-icons text-template">receipt</i>
                            </div>
                            <p class="small mt-2">Bills</p>
                        </a>
                        <a href="#" class="swiper-slide text-center">
                            <div class="avatar avatar-60 no-shadow border-0">
                                <div class="overlay bg-template"></div>
                                <i class="material-icons text-template">monetization_on</i>
                            </div>
                            <p class="small mt-2">Bitcoin</p>
                        </a>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- page content here -->
            <h6 class="subtitle">Today</h6>
            <div class="row">
                <div class="col-12 px-0">
                    <ul class="list-group list-group-flush border-top border-bottom">
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto pr-0">
                                    <div class="avatar avatar-50 no-shadow border-0">
                                        <div class="overlay bg-template"></div>
                                        <i class="material-icons text-template">phone</i>
                                    </div>
                                </div>
                                <div class="col align-self-center pr-0">
                                    <h6 class="font-weight-normal mb-1">Ms. Shivani Dilux</h6>
                                    <p class="text-mute small text-secondary">15-1-2020, 8:00 am</p>
                                </div>
                                <div class="col-auto">
                                    <h6 class="text-success">$154.0</h6>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <h6 class="subtitle">Yesterday</h6>
            <div class="row">
                <div class="col-12 px-0">
                    <ul class="list-group list-group-flush border-top border-bottom">
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto pr-0">
                                    <div class="avatar avatar-50 no-shadow border-0">
                                        <div class="overlay bg-template"></div>
                                        <i class="material-icons text-template">phone</i>
                                    </div>
                                </div>
                                <div class="col align-self-center pr-0">
                                    <h6 class="font-weight-normal mb-1">Ms. Shivani Dilux</h6>
                                    <p class="text-mute small text-secondary">15-1-2020, 8:00 am</p>
                                </div>
                                <div class="col-auto">
                                    <h6 class="text-success">$154.0</h6>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
                <div class="col-12 px-0">
                    <ul class="list-group list-group-flush border-top border-bottom">
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto pr-0">
                                    <div class="avatar avatar-50 no-shadow border-0">
                                        <div class="overlay bg-template"></div>
                                        <i class="material-icons text-template">phone</i>
                                    </div>
                                </div>
                                <div class="col align-self-center pr-0">
                                    <h6 class="font-weight-normal mb-1">Ms. Shivani Dilux</h6>
                                    <p class="text-mute small text-secondary">15-1-2020, 8:00 am</p>
                                </div>
                                <div class="col-auto">
                                    <h6 class="text-success">$154.0</h6>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <h6 class="subtitle">3 DEC 2020</h6>
            <div class="row">
                <div class="col-12 px-0">
                    <ul class="list-group list-group-flush border-top border-bottom">
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto pr-0">
                                    <div class="avatar avatar-50 no-shadow border-0">
                                        <div class="overlay bg-template"></div>
                                        <i class="material-icons text-template">phone</i>
                                    </div>
                                </div>
                                <div class="col align-self-center pr-0">
                                    <h6 class="font-weight-normal mb-1">Ms. Shivani Dilux</h6>
                                    <p class="text-mute small text-secondary">15-1-2020, 8:00 am</p>
                                </div>
                                <div class="col-auto">
                                    <h6 class="text-success">$154.0</h6>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- page content ends -->
        </div>
        <!-- footer-->
    @include('partials.footer')
    <!-- footer ends-->
    </div>
@endsection
