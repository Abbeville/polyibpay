@extends('layouts.master')

@section('contents')


    <div class="wrapper">

        <!-- header -->
    @include('partials.header')

    <!-- header ends -->

        <div class="container">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif

            <form action="{{ route('users.create.bill') }}" method="POST">
                @csrf
                <h6 class="subtitle">Buy {{ ucwords($category) }}</h6>
                @if($category == 'airtime')
                    @include('users.dashboard.bill.airtime')
                @elseif($category == 'data_bundle')
                    @include('users.dashboard.bill.data-bundle')
                @elseif($category == 'electricity')
                    @include('users.dashboard.bill.electricity')
                @elseif($category == 'tv_subscription')
                    @include('users.dashboard.bill.cable')
                @endif

                <input type="hidden" name="country" value="NG">
                <input type="hidden" name="recurrence" value="ONCE">

                <hr>
                <button class="btn btn-lg btn-default text-white btn-block btn-rounded shadow mt-50">Submit</button>
            </form>


        </div>

        <!-- footer-->
    @include('partials.footer')
    <!-- footer ends-->
    </div>
@endsection

@section('scripts')

    <script type="text/javascript">
        $('#biller_name').change(function(){
            $("input[name='amount']").val($(this).find(':selected').data('amount'));
            $("input[name='biller_code']").val($(this).find(':selected').data('biller_code'));
            $("input[name='item_code']").val($(this).find(':selected').data('item_code'));
        });
    </script>

@endsection
