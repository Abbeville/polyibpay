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
                                    <th>Amount (NGN)</th>
                                    <th>Amount (Crypto)</th>
                                    <th>Rate of Exchange</th>
                                    <th>Status</th>
                                    <th>Date of Transaction</th>
                                </thead>

                                @forelse($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('users.transactions.crypto-transfer', ['request' => $transaction->request_id]) }}">{{ $transaction->request_id }}</a>
                                    </td>
                                    <td>N{{ number_format($transaction->amount_ngn) }}</td>
                                    <td>{{ $transaction->amount_crypto }}</td>
                                    <td>N{{ $transaction->current_rate }}/$</td>
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
            <ul class="pagination">
                {{ $transactions->links() }}
            </ul>
        </div>
        <!-- footer-->
    @include('partials.footer')
    <!-- footer ends-->
    </div>
@endsection
