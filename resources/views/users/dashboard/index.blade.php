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
                            <h3 class="mb-0 font-weight-normal">@mon($wallet_balance)</h3>
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
                        <a href="#" class="swiper-slide text-center" data-toggle="modal" data-target="#airtimeModal">
                            <div class="avatar avatar-60 no-shadow border-0">
                                <div class="overlay bg-template"></div>
                                <i class="material-icons text-template">phone</i>
                            </div>
                            <p class="small mt-2">Airtime</p>
                        </a>
                        <a href="#" class="swiper-slide text-center" data-toggle="modal" data-target="#dataBundleModal">
                            <div class="avatar avatar-60 no-shadow border-0">
                                <div class="overlay bg-template"></div>
                                <i class="material-icons text-template">language</i>
                            </div>
                            <p class="small mt-2">Data</p>
                        </a>
                        <a href="#" class="swiper-slide text-center" data-toggle="modal" data-target="#cableTvModal">
                            <div class="avatar avatar-60 no-shadow border-0">
                                <div class="overlay bg-template"></div>
                                <i class="material-icons text-template">tv</i>
                            </div>
                            <p class="small mt-2">Cable TV</p>
                        </a>
                        <a href="#" class="swiper-slide text-center" data-toggle="modal" data-target="#electricityModal">
                            <div class="avatar avatar-60 no-shadow border-0">
                                <div class="overlay bg-template"></div>
                                <i class="material-icons text-template">power</i>
                            </div>
                            <p class="small mt-2">Electricity</p>
                        </a>
                        <a href="{{ route('users.transactions.crypto') }}" class="swiper-slide text-center">
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
            @forelse($transactions['today'] as $transaction)
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
                                        <h6 class="font-weight-normal mb-1">{{ $transaction->category == 'wallet' ? 'Wallet Top Up' : ucwords(str_replace('_', ' ', $transaction->category)) }}</h6>
                                        <p class="text-mute small text-secondary">{{ $transaction->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-{{ ($transaction->type == 'credit') ? 'success' : 'danger' }}">@mon($transaction->amount)</h6>
                                        <p class="text-mute small text-secondary">{{ $transaction->status }}</p>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            @empty
                <div class="row">
                    <div class="col-12 px-0">
                        <ul class="list-group list-group-flush border-top border-bottom">
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        {{-- <div class="avatar avatar-50 no-shadow border-0">
                                            <div class="overlay bg-template"></div>
                                            <i class="material-icons text-template">phone</i>
                                        </div> --}}
                                    </div>
                                    <div class="col align-self-center pr-0">
                                        {{ 'No transaction today' }}
                                    </div>
                                    <div class="col-auto">
                                        
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            @endforelse

            <h6 class="subtitle">Yesterday</h6>
            @forelse($transactions['yesterday'] as $transaction)
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
                                        <h6 class="font-weight-normal mb-1">{{ $transaction->category == 'wallet' ? 'Wallet Top Up' : ucwords(str_replace('_', ' ', $transaction->category)) }}</h6>
                                        <p class="text-mute small text-secondary">{{ $transaction->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-{{ ($transaction->type == 'credit') ? 'success' : 'danger' }}">@mon($transaction->amount)</h6>
                                        <p class="text-mute small text-secondary">{{ $transaction->status }}</p>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            @empty
                <div class="row">
                    <div class="col-12 px-0">
                        <ul class="list-group list-group-flush border-top border-bottom">
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        {{-- <div class="avatar avatar-50 no-shadow border-0">
                                            <div class="overlay bg-template"></div>
                                            <i class="material-icons text-template">phone</i>
                                        </div> --}}
                                    </div>
                                    <div class="col align-self-center pr-0">
                                        {{ 'No transaction today' }}
                                    </div>
                                    <div class="col-auto">
                                        
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            @endforelse

            <h6 class="subtitle">Last Month</h6>
            @forelse($transactions['last_month'] as $transaction)
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
                                        <h6 class="font-weight-normal mb-1">{{ $transaction->category == 'wallet' ? 'Wallet Top Up' : ucwords(str_replace('_', ' ', $transaction->category)) }}</h6>
                                        <p class="text-mute small text-secondary">{{ $transaction->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-{{ ($transaction->type == 'credit') ? 'success' : 'danger' }}">@mon($transaction->amount)</h6>
                                        <p class="text-mute small text-secondary">{{ $transaction->status }}</p>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            @empty
                <div class="row">
                    <div class="col-12 px-0">
                        <ul class="list-group list-group-flush border-top border-bottom">
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        {{-- <div class="avatar avatar-50 no-shadow border-0">
                                            <div class="overlay bg-template"></div>
                                            <i class="material-icons text-template">phone</i>
                                        </div> --}}
                                    </div>
                                    <div class="col align-self-center pr-0">
                                        {{ 'No transaction today' }}
                                    </div>
                                    <div class="col-auto">
                                        
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            @endforelse

            <!-- page content ends -->
        </div>
        <!-- footer-->
    @include('partials.footer')
    <!-- footer ends-->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addmoney" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('fund-wallet') }}" id="paymentForm">
                    <div class="modal-body text-center pt-0">
                        <img src="img/infomarmation-graphics2.png" alt="logo" class="logo-small">
                        
                            {{ csrf_field() }} 
                            <input type="hidden" name="payment_method" value="both" /> 
                            <input type="hidden" name="description" value="No description" /> 
                            <input type="hidden" name="country" value="NG" /> 
                            <input type="hidden" name="currency" value="NGN" /> 
                            <input type="hidden" name="email" value="{{ auth()->user()->email }}" />
                            <input type="hidden" name="firstname" value="{{ auth()->user()->firstname }}" />
                            <input type="hidden" name="lastname" value="{{ auth()->user()->firstname }}" />
                            {{-- <input type="hidden" name="metadata" value="{{ json_encode($array) }}" >  --}}<!-- Meta data that might be needed to be passed to the Rave Payment Gateway -->
                            <input type="hidden" name="phonenumber" value="{{ auth()->user()->phone_number }}" /> 
                            <input type="hidden" name="ref" value="{{ $txref }}" /> 
                            <input type="hidden" name="category" value="wallet" /> 
                            <input type="hidden" name="logo" value="https://pbs.twimg.com/profile_images/915859962554929153/jnVxGxVj.jpg" /> <!-- Replace the value with your logo url (Optional, present in .env)-->
                            <input type="hidden" name="title" value="BillsPay" /> 
                            {{-- <input type="referrer" name="location" value="empty"> --}}

                            <div class="form-group mt-4">
                                <input type="text" name="amount" class="form-control form-control-lg text-center" placeholder="Enter amount"
                                       required="" autofocus="" value="{{ Session::has('amount_to_recharge') ? session('amount_to_recharge') : '' }}">
                            </div>
                            @if(Session::has('amount_to_recharge'))
                                <p class="text-danger">You have insufficient balance in your wallet to complete your transaction. Please recharge now.</p>
                            @else
                                <p class="text-mute">You will be redirected to payment gatway to proceed further. Enter amount in
                                    Naira.</p>
                            @endif
                    </div>
                    <div class="modal-footer border-0">
                        <input type="submit" class="btn btn-default btn-lg btn-rounded shadow btn-block" value="Next" class="close">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Fund Wallet -->

    <!-- Modal -->
    <div class="modal fade" id="completeTransaction" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('users.create.bill') }}" id="paymentForm">
                    <div class="modal-body text-center pt-0">
                        <img src="img/infomarmation-graphics2.png" alt="logo" class="logo-small">
                        
                            {{ csrf_field() }} 
                            <input type="hidden" name="item_code" value="{{ Session::has('pending_bill') ? session('pending_bill')['item_code'] : '' }}" /> 
                            <input type="hidden" name="country" value="{{ Session::has('pending_bill') ? session('pending_bill')['country'] : '' }}" /> 
                            <input type="hidden" name="customer" value="{{ Session::has('pending_bill') ? session('pending_bill')['customer'] : '' }}" /> 
                            <input type="hidden" name="amount" value="{{ Session::has('pending_bill') ? session('pending_bill')['amount'] : '' }}" /> 
                            <input type="hidden" name="recurrence" value="{{ Session::has('pending_bill') ? session('pending_bill')['recurrence'] : '' }}" /> 
                            <input type="hidden" name="type" value="{{ Session::has('pending_bill') ? session('pending_bill')['type'] : '' }}" /> 
                            <input type="hidden" name="biller_code" value="{{ Session::has('pending_bill') ? session('pending_bill')['biller_code'] : '' }}" /> 
                            
                            <p class="text-mute">We notice a pending transaction on your account </p>       
                            <p class="text-mute">Transaction Details: </p>       
                            <p class="text-mute">Amount :  {{ Session::has('pending_bill') ? session('pending_bill')['amount'] : '' }}</p>       
                            <p class="text-mute">Number : {{ Session::has('pending_bill') ? session('pending_bill')['customer'] : '' }} </p>       
                    </div>
                    <div class="modal-footer border-0">
                        <input type="submit" class="btn btn-default btn-lg btn-rounded shadow btn-block" value="Next" class="close">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Fund Wallet -->

    <!-- Modal -->
    <div class="modal fade" id="airtimeModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5>Buy Airtime</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0">

                    @foreach($airtime as $airtime_biller)
                    <a href="{{ route('users.purchase.category', ['airtime', $airtime_biller->biller_code ]) }}">
                        <div class="card shadow border-0 mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <div class="avatar avatar-60 no-shadow border-0">
                                            <img src="{{ asset('/').$airtime_biller->thumbnail_path }}" alt="{{ Str::lower($airtime_biller->name) }}">
                                        </div>
                                    </div>
                                    <div class="col align-self-center">
                                        <h6 class="font-weight-normal mb-1">{{ $airtime_biller->name }}</h6>
                                        {{-- <p class="text-mute small text-secondary">London, UK</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <!-- Modal -->
    <div class="modal fade" id="dataBundleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5>Buy Data Bundle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <form method="POST" action="{{-- {{ route('user.bill.purchase', ['airtime']) }} --}}">

                        @foreach($data_bundle as $data_biller)
                        <a href="{{ route('users.purchase.category', ['data_bundle', $data_biller->biller_code ]) }}">
                            <div class="card shadow border-0 mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto pr-0">
                                            <div class="avatar avatar-60 no-shadow border-0">
                                                <img src="{{ asset('/').$data_biller->thumbnail_path }}" alt="{{ Str::lower($data_biller->name) }}">
                                            </div>
                                        </div>
                                        <div class="col align-self-center">
                                            <h6 class="font-weight-normal mb-1">{{ $data_biller->name }}</h6>
                                            {{-- <p class="text-mute small text-secondary">London, UK</p> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <!-- Modal -->
    <div class="modal fade" id="cableTvModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5>Cable TV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    @foreach($tv_subscription as $tv_biller)
                    <a href="{{ route('users.purchase.category', ['tv_subscription', $tv_biller->biller_code ]) }}">
                        <div class="card shadow border-0 mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <div class="avatar avatar-60 no-shadow border-0">
                                            <img src="{{ asset('/').$tv_biller->thumbnail_path }}" alt="{{ Str::lower($tv_biller->name) }}">
                                        </div>
                                    </div>
                                    <div class="col align-self-center">
                                        <h6 class="font-weight-normal mb-1">{{ $tv_biller->name }}</h6>
                                        {{-- <p class="text-mute small text-secondary">London, UK</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <!-- Modal -->
    <div class="modal fade" id="electricityModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5>Electricity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    @foreach($electricity as $electricity_biller)
                    <a href="{{ route('users.purchase.category', ['electricity', $electricity_biller->biller_code ]) }}">
                        <div class="card shadow border-0 mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <div class="avatar avatar-60 no-shadow border-0">
                                            <img src="{{ asset('/').$electricity_biller->thumbnail_path }}" alt="{{ Str::lower($electricity_biller->name) }}">
                                        </div>
                                    </div>
                                    <div class="col align-self-center">
                                        <h6 class="font-weight-normal mb-1">{{ $electricity_biller->name }}</h6>
                                        {{-- <p class="text-mute small text-secondary">London, UK</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->



@endsection

@if(Session::has('amount_to_recharge'))

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){ 
            $("#addmoney").modal("show");
         });
    </script>
@endsection

@endif

@if(Session::has('pending_bill'))

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){ 
            $("#completeTransaction").modal("show");
         });
    </script>
@endsection

@endif
