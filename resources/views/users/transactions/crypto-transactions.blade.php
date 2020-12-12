@extends('layouts.master')

@section('contents')


    <div class="wrapper">

        <!-- header -->
    @include('partials.header')

    <!-- header ends -->

        <div class="container">
            <div class="row mt-3">
                <div class="col-12 px-0">
                    <div>
                        <div>
                            <table class="table  table-striped">
                                <thead>
                                    <th>#</th>
                                    <th>Request ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </thead>

                                @forelse($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->request_id }}</td>
                                    <td>{{ $transaction->amount }}</td>
                                    <td>{{ $transaction->status }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                </tr>

                                @empty
                                    <p class="text-center">You have no Cryptocurrency transactions ye</p>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- footer-->
    @include('partials.footer')
    <!-- footer ends-->
    </div>
@endsection
