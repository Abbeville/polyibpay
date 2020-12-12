@extends('layouts.master')

@section('contents')


    <div class="wrapper">

        <!-- header -->
    @include('partials.header')

    <!-- header ends -->

        <div class="container">

            <h6 class="subtitle">Withdrawal Account</h6>
            <form action="{{ route('users.settings.bank.update') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        @if(Session::has('error'))
                            <div class="alert alert-warning">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <div class="form-group float-label active">
                            <select name="bank" class="form-control select2-dropdown" id="">
                                @forelse($data['banks'] as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @empty

                                @endforelse
                            </select>
                            <label class="form-control-label">Bank</label>

                            <small class="text-small text-danger">
                                @error('bank')
                                {{ $message }}
                                @enderror
                            </small>

                        </div>

                        <div class="form-group float-label active">
                            <input type="text" class="form-control" name="account_name" value="{{ old('account_name') }}">
                            <label class="form-control-label">Account Name</label>

                            <small class="text-small text-danger">
                                @error('account_name')
                                {{ $message }}
                                @enderror
                            </small>

                        </div>

                        <div class="form-group float-label active">
                            <input type="text" inputmode="numeric" class="form-control" name="account_number" value="{{ old('account_number') }}">
                            <label class="form-control-label">Account Number</label>
                            <small class="text-small text-danger">
                                @error('account_number')
                                {{ $message }}
                                @enderror
                            </small>
                        </div>

                        <div class="form-group float-label active">
                            <select name="account_type" id="" class="form-control">
                                <option value="savings" selected>Savings</option>
                                <option value="current">Current</option>
                            </select>
                            <label class="form-control-label">Account Type</label>
                            <small class="text-small text-danger">
                                @error('password_confirmation')
                                {{ $message }}
                                @enderror
                            </small>
                        </div>

                            <div class="form-group float-label active">
                                <input type="text" class="form-control" name="btc_address" value="{{ old('btc_address') }}">
                                <label class="form-control-label">BTC Address</label>

                                <small class="text-small text-danger">
                                    @error('btc_address')
                                    {{ $message }}
                                    @enderror
                                </small>

                            </div>

                            <div class="form-group float-label active">
                                <input type="text" class="form-control" name="btc_address" value="{{ old('btc_address') }}">
                                <label class="form-control-label">ETH Address</label>

                                <small class="text-small text-danger">
                                    @error('btc_address')
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
