@extends('layouts.master')
@php
    $categories = [
        'all' => 'Filter By Category',
        'airtime' => 'Airtime Purchase',
        'bill' => 'Bill Payment',
        'wallet' => 'Wallet Topup',
        'vcard' => 'Virtual Card TopUp',
        'data_bundle' => 'Data Bundle Purchase',
        'crypto' => 'Crypto Purchase',
    ]
    
@endphp
@section('contents')


    <div class="wrapper">

        <!-- header -->
    @include('partials.header')

    <!-- header ends -->

        <div class="container">
            <div class="row mt-3 m-3">
                <div class="col-6 px-0">
                    <div class="form-group float-label active">
                        <select class="form-control form-control-lg text-center" name="category" id="category">
                            <option selected="" disabled="">Filter By Category</option>
                            @foreach($categories as $key => $cat)
                                <option value="{{ $key }}" {{ $key == $category ? 'selected=""' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            @forelse($transactions as $transaction)
                <div class="row">
                    <div class="col-12 px-0">
                        <ul class="list-group list-group-flush border-top border-bottom">
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <div class="avatar avatar-50 no-shadow border-0">
                                            <div class="overlay bg-template"></div>
                                            {{-- <i class="material-icons text-template">phone</i> --}}
                                        </div>
                                    </div>
                                    <div class="col align-self-center pr-0">
                                        <h6 class="font-weight-normal mb-1">{{ $categories[$transaction->category] }}</h6>
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
                                        
                                    </div>
                                    <div class="col align-self-center pr-0">
                                        {{ 'No transaction' }}
                                    </div>
                                    <div class="col-auto">
                                        
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            @endforelse
            
            <div class="row mt-3">
                <div class="col-12 px-0">
                    <div>
                        <div>
                            
                        </div>
                    </div>

                    <div class="mt-3">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>

        </div>
        <!-- footer-->
    @include('partials.footer')
    <!-- footer ends-->
    </div>
@endsection

@section('scripts')

    <script type="text/javascript">
        var url = '{{ route('users.transactions') }}';

        $('#category').change(function(){
            var category = $(this).find(':selected').val();

            $location = url+'/'+category;

            window.location.href= $location;
        });
    </script>

@endsection
