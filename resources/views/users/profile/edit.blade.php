@extends('layouts.master')

@section('contents')


    <div class="wrapper">

        <!-- header -->
    @include('partials.header')

    <!-- header ends -->

        <div class="container">

            <h6 class="subtitle">Update Personal Details</h6>
            <form action="{{ route('users.profile.update') }}" method="post">
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
                                @if($profile)
                                    <option value="{{ $profile->bank_name_id }}" selected>{{ getBankName($profile->bank_name_id) }}</option>
                                @endif
                                @forelse($banks as $bank)
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
                            <input type="text" class="form-control" name="account_name" value="{{ $profile ? $profile->bank_account_name : '' }}">
                            <label class="form-control-label">Account Name</label>

                            <small class="text-small text-danger">
                                @error('account_name')
                                {{ $message }}
                                @enderror
                            </small>

                        </div>

                        <div class="form-group float-label active">
                            <input type="text" inputmode="numeric" class="form-control" name="account_number" value="{{ $profile ? $profile->bank_account_number : '' }}">
                            <label class="form-control-label">Account Number</label>
                            <small class="text-small text-danger">
                                @error('account_number')
                                {{ $message }}
                                @enderror
                            </small>
                        </div>

                        <div class="form-group float-label active">
                            <select name="account_type" id="" class="form-control">
                                <option value="savings">Savings</option>
                                <option value="current" @if($profile->bank_account_type == 'current') selected @endif>Current</option>
                            </select>
                            <label class="form-control-label">Account Type</label>
                            <small class="text-small text-danger">
                                @error('password_confirmation')
                                {{ $message }}
                                @enderror
                            </small>
                        </div>

                            <div class="form-group float-label active">
                                <input type="text" class="form-control" name="btc_address" value="{{ $profile ? $profile->btc_address : '' }}">
                                <label class="form-control-label">BTC Address</label>

                                <small class="text-small text-danger">
                                    @error('btc_address')
                                    {{ $message }}
                                    @enderror
                                </small>

                            </div>

                            <div class="form-group float-label active">
                                <input type="text" class="form-control" name="eth_address" value="{{ $profile ? $profile->eth_address : '' }}">
                                <label class="form-control-label">ETH Address</label>

                                <small class="text-small text-danger">
                                    @error('eth_address')
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
                        <div class="form-group">
                            <div>
{{--                                <label for="pin">Confirm</label>--}}
                            </div>
                            <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="pin1">
                            <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="pin2">
                            <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="pin3">
                            <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="pin4">

                            @error('pin')
                                {{ $message }}
                            @enderror
                        </div>

                        <p><small>Enter transaction pin to confirm update</small></p>
                        <input type="hidden" name="pin" id="pin">
                        <hr>
                        <button type="submit" class="btn btn-lg btn-default text-white btn-block btn-rounded shadow mt-50" id="update">Update</button>
{{--                        <button type="button" class="btn btn-lg btn-default text-white btn-block btn-rounded shadow mt-50" data-toggle="modal" data-target="#pin-modal">Update</button>--}}
                        <!-- Modal -->
{{--                        <div class="container">--}}
{{--                            <div class="modal fade" id="pin-modal" tabindex="-1" role="dialog" aria-labelledby="pin-modal" aria-hidden="true">--}}
{{--                                <div class="modal-dialog" role="document">--}}
{{--                                    <div class="modal-content">--}}
{{--                                        <div class="modal-header">--}}
{{--                                            <h5 class="modal-title" id="pin-modalLabel">Confirm Update</h5>--}}
{{--                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                <span aria-hidden="true">&times;</span>--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                        <div class="modal-body text-center">--}}
{{--                                            <label class="">Enter Transaction Pin</label>--}}

{{--                                            <div class="form-group">--}}
{{--                                                <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="pin1">--}}
{{--                                                <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="pin2">--}}
{{--                                                <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="pin3">--}}
{{--                                                <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="pin4">--}}
{{--                                            </div>--}}


{{--                                            <input type="hidden" name="pin" id="pin">--}}
{{--                                        </div>--}}
{{--                                        <div class="modal-footer">--}}
{{--                                            <button type="submit" class="btn btn-primary btn-default text-white btn-block btn-rounded shadow mt-50" id="confirm">Confirm</button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
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
    <script>
        $(document).ready(function(){
            // $('#pin-modal').on('shown.bs.modal', function () {
            //     $('#pin1').trigger('focus')
            // })

            $(".pin").keyup(function() {
                if($(this).val().length >= 1) {
                    var input_flds = $(this).closest('form').find(':input');
                    input_flds.eq(input_flds.index(this) + 1).focus();
                }
            });

            $('#update').click(function(){
                let pin1 = $("#pin1").val();
                let pin2 = $("#pin2").val();
                let pin3 = $("#pin3").val();
                let pin4 = $("#pin4").val();
                let pin  = pin1 + pin2 + pin3 + pin4;
                $("#pin").val(pin);
            })
        })
    </script>
@endsection
