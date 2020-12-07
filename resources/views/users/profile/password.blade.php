@extends('layouts.master')

@section('contents')


    <div class="wrapper">

        <!-- header -->
    @include('partials.header')

    <!-- header ends -->

        <div class="container">

            <h6 class="subtitle">Change Password</h6>
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



            <hr>
            <button class="btn btn-lg btn-default text-white btn-block btn-rounded shadow mt-50">Submit</button>



        </div>

        <!-- footer-->
    @include('partials.footer')
    <!-- footer ends-->
    </div>
@endsection
