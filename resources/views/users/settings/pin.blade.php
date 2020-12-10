@extends('layouts.master')

@section('contents')


    <div class="wrapper">

        <!-- header -->
    @include('partials.header')

    <!-- header ends -->

        <div class="container">

            <h6 class="subtitle">Update Transaction Pin</h6>
            <form action="{{ route('users.settings.pin.update') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        @if(Session::has('error'))
                            <div class="alert alert-warning">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        @if(auth()->user()->pin != '')
                            <div class="form-group float-label active">
                                <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="cpin1">
                                <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="cpin2">
                                <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="cpin3">
                                <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="cpin4">

                                <input type="hidden" name="cpin" id="cpin">
                                <label class="form-control-label">Current Pin </label>

                                <p>
                                    <small class="text-small text-danger">
                                        @error('cpin')
                                        {{ $message }}
                                        @enderror
                                    </small>
                                </p>

                            </div>
                        @endif
                        <div class="form-group float-label active ">
                            <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="pin1">
                            <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="pin2">
                            <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="pin3">
                            <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="pin4">

                            <input type="hidden" name="pin" id="pin">
                            <label class="form-control-label">New Pin</label>

                            <p>
                                <small class="text-small text-danger">
                                    @error('pin')
                                    {{ $message }}
                                    @enderror
                                </small>
                            </p>


                        </div>

                        <div class="form-group float-label active">
                            <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="pinc1">
                            <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="pinc2">
                            <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="pinc3">
                            <input type="password" inputmode="numeric"  class="pin" maxlength="1" id="pinc4">

                            <input type="hidden" name="pin_confirmation" id="pinc">

                            {{--                            <input type="password" class="form-control" maxlength="4" inputmode="numeric" name="pin_confirmation" value="{{ old('current-password') }}">--}}
                            <label class="form-control-label">Confirm Pin</label>

                            <p>
                                <small class="text-small text-danger">
                                    @error('pin_confirmation')
                                    {{ $message }}
                                    @enderror
                                </small>
                            </p>


                        </div>


                    </div>
                    <div class="col-12 col-md-6">

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <hr>
                        <button type="submit" id="update_pin" class="btn btn-lg btn-default text-white btn-block btn-rounded shadow mt-50">Update</button>
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

    <script >
        $(document).ready(function(){
            $(".pin").keyup(function() {
                if($(this).val().length >= 1) {
                    var input_flds = $(this).closest('form').find(':input');
                    input_flds.eq(input_flds.index(this) + 1).focus();
                }
            });

            $("#update_pin").click(function(){
                let pin1 = $("#pin1").val();
                let pin2 = $("#pin2").val();
                let pin3 = $("#pin3").val();
                let pin4 = $("#pin4").val();
                let pin  = pin1 + pin2 + pin3 + pin4;
               $("#pin").val(pin);

                let pinc1 = $("#pinc1").val();
                let pinc2 = $("#pinc2").val();
                let pinc3 = $("#pinc3").val();
                let pinc4 = $("#pinc4").val();
                let pinc  = pinc1 + pinc2 + pinc3 + pinc4;
                $("#pinc").val(pinc);

                @if(auth()->user()->pin != '')
                    let cpin1 = $("#cpin1").val();
                    let cpin2 = $("#cpin2").val();
                    let cpin3 = $("#cpin3").val();
                    let cpin4 = $("#cpin4").val();
                    let cpin  = cpin1 + cpin2 + cpin3 + cpin4;
                    $("#cpin").val(cpin);
                @endif

               // return false;
            });

        })
    </script>
@endsection
