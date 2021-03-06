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
                        <div class="alert alert-info">
                            Currrent Exchange Rate: {{ $btc_rate->value }} / $
                        </div>
                            <div class="form-group float-label active">
                                <input type="text" class="form-control" value="BTC" readonly>
                                <label class="form-control-label">Crypto</label>
                            </div>


                            <div class="form-group float-label active">
                                <label class="form-control-label">Amount (in USD)</label>
                                <input type="text" inputmode="numeric" name="amount_d" class="form-control money" id="amount_d"  value="{{ old('amount') }}" id="money">
                                <input type="hidden" name="amount_usd" id="amount_usd">
                               <p>
                                   <small class="text-danger">
                                       @error('amount')
                                       {{ $message }}
                                       @enderror
                                   </small>
                               </p>
                            </div>

                        <div class="form-group">
                            <label class="form-control-label">Amount (in crypto)</label>
                            <input type="text" name="amount_crypto" class="form-control" readonly id="amount_crypto"  value="{{ old('amount') }}" placeholder="0.638427357">

                            <p>
                                <small class="text-danger">
                                    @error('amount')
                                    {{ $message }}
                                    @enderror
                                </small>
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="amount_ngn" class="form-control-label">Amount (NGN)</label>
                            <input type="text" class="money form-control " id="amount_ngn" readonly>
                        </div>


                        <hr>
                            <button type="submit"id="submit" class="btn btn-lg btn-default text-white btn-block btn-rounded shadow mt-50">Submit</button>
                        </div>


                 </div>
            </form>





        </div>

        <!-- footer-->
    @include('partials.footer')
    <!-- footer ends-->

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready( () => {
            $('.money').mask('00,000.00', {reverse: true});
            function fetch(){
                var amount_usd = $('#amount_d').val();
                if(amount_usd.indexOf(',') !== -1){
                    amount_usd = amount_usd.replace(',', '');
                }

                $('#amount_usd').val(amount_usd);


                $.get(`https://blockchain.info/tobtc?currency=USD&value=${amount_usd}`, (data)=>{
                    $('#amount_crypto').val(data);
                    let amount_ngn = amount_usd * {{ $btc_rate->value }} ;
                    $('#amount_ngn').val(parseFloat(amount_ngn));
                });
            }

            $('#amount_d').keyup(()=>{
                fetch();
            });


        });



    </script>
@endsection
