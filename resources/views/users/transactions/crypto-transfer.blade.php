@extends('layouts.master')

@section('contents')


    <div class="wrapper">

        <!-- header -->
    @include('partials.header')

    <!-- header ends -->

        <div class="container">

            <h6 class="subtitle">Cryptocurrency Transfer</h6>
            <p>
                <small>
                    Exchange Request  - #<a href="{{ route('users.transactions.crypto-transfer', ['request' => $request]) }}">{{ $request }}</a>
                </small>
            </p>
            <div class="row">
                <div class="col-12 col-md-6">
                    @if($crypto_request->hash_code == '')
                        <div class="form-group float-label active">
                            <input type="text" class="form-control" value="{{ $wallet }}" readonly>
                            <label class="form-control-label">Make transfer to this address</label>
                        </div>
                    @endif

                    @if($crypto_request->hash_code == '')
                        <form action="{{ route('users.transactions.crypto-transfer.save', ['request' => $request]) }}" method="post" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group  active">
                            <label class="form-control-label">Hash Code</label>
                            <input type="text" name="hash" class="form-control" value="{{ $crypto_request->hash_code ? $crypto_request->hash_code : '' }}" placeholder="06eb401a94f1e9d3423848804a0e4ede180d">

                            <p>
                                <small class="text-small text-danger">
                                    @error('hash')
                                    {{ $message }}
                                    @enderror
                                </small>
                            </p>
                        </div>

                        <div class="form-group  active">
                                <label class="form-control-label">Proof (Screenshot of Transfer)</label>
                                <input type="file" name="proof" class="form-control-file" >

                                <p>
                                    <small class="text-small text-danger">
                                        @error('proof')
                                        {{ $message }}
                                        @enderror
                                    </small>
                                </p>

                        </div>

                        <hr>
                        <button type="submit" class="btn btn-lg btn-default text-white btn-block btn-rounded shadow mt-50">Submit</button>

                    </form>
                    @else
                        <div class="alert alert-info">
                            <p><b>Hash: {{ $crypto_request->hash_code }}</b></p>
                        </div>

                        <div >
                            <img src="/storage/{{ $crypto_request->proof_file }}" alt="proof_file" style="height: 250px; width:250px;">
                        </div>
                    @endif
             </div>

            </div>





        </div>

        <!-- footer-->
    @include('partials.footer')
    <!-- footer ends-->
    </div>
@endsection
