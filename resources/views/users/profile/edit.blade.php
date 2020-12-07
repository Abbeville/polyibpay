@extends('layouts.master')

@section('contents')


    <div class="wrapper">

        <!-- header -->
    @include('partials.header')

    <!-- header ends -->

        <div class="container">

            <h6 class="subtitle">Basic Information</h6>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group float-label active">
                        <input type="text" class="form-control" required="" value="Angelina Johnson">
                        <label class="form-control-label">Name</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group float-label active">
                        <input type="email" class="form-control" required="" value="angelinaJohnson@maxartkiller.com">
                        <label class="form-control-label">Email address</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group float-label active mb-0">
                        <input type="tel" class="form-control" required="" value="55 5555 555555 55">
                        <label class="form-control-label">Phone Number</label>
                    </div>
                </div>
            </div>


            <hr>
            <button class="btn btn-lg btn-default text-white btn-block btn-rounded shadow mt-50">Submit</button>



        </div>

        <!-- footer-->
    @include('partials.footer')
    <!-- footer ends-->
    </div>
@endsection
