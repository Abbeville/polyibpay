@extends('layouts.master')

@section('contents')


    <div class="wrapper">

        <!-- header -->
    @include('partials.header')

    <!-- header ends -->

        <div class="container">

            <h6 class="subtitle">Cryptocurrency Exchange Request</h6>
            <form action="{{ route('users.transactions.crypto-request.save') }}" method="post">

                <div class="row">
                    @csrf
                    <div class="col-12 col-md-6">
                            <div class="form-group float-label active">
                                <input type="text" class="form-control" value="BTC" readonly>
                                <label class="form-control-label">Crypto</label>
                            </div>

                            <div class="form-group float-label active">
                                <input type="text" name="amount" class="form-control"  value="{{ old('amount') }}" placeholder="0.638427357">
                                <label class="form-control-label">Amount (in crypto)</label>

                               <p>
                                   <small class="text-danger">
                                       @error('amount')
                                       {{ $message }}
                                       @enderror
                                   </small>
                               </p>
                            </div>

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
