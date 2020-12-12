@extends('layouts.master')

@section('contents')


    <div class="wrapper">

        <!-- header -->
    @include('partials.header')

    <!-- header ends -->

        <div class="container">

            <h6 class="subtitle">Cryptocurrency Exchange Request</h6>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group float-label active">
                        <input type="text" class="form-control" value="BTC" readonly>
                        <label class="form-control-label">Crypto</label>
                    </div>

                    <div class="form-group float-label active">
                        <input type="amount" class="form-control" required="" value="{{ old('amount') }}" placeholder="0.638427357">
                        <label class="form-control-label">Amount (in crypto)</label>
                    </div>

                    <hr>
                    <button class="btn btn-lg btn-default text-white btn-block btn-rounded shadow mt-50">Submit</button>
                </div>

            </div>





        </div>

        <!-- footer-->
    @include('partials.footer')
    <!-- footer ends-->
    </div>
@endsection
