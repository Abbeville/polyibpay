@extends('admin.layout.auth_master')

@section('page_title', 'Admin Transaction Management')

@section('more_css')
{{-- More CSS here --}}
   <link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">


@endsection

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Transactions Management</h1>
   <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">All Transactions</li>
   </ol>
</div>


<div class="row mb-3">
   <!-- Earnings (Monthly) Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
         <div class="row align-items-center">
          <div class="col mr-2">
           <div class="text-xs font-weight-bold text-uppercase mb-1">All Transactions</div>
           <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($all_transactions) }}</div>
           <div class="mt-2 mb-0 text-muted text-xs">
            {{-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> --}}
            <span>All kinds of transaction that occur on system</span>
         </div>
      </div>
      <div class="col-auto">
        <i class="fas fa-list-alt fa-2x text-primary"></i>
     </div>
  </div>
</div>
</div>
</div>
<!-- Earnings (Annual) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
   <div class="card h-100">
     <div class="card-body">
      <div class="row no-gutters align-items-center">
       <div class="col mr-2">
        <div class="text-xs font-weight-bold text-uppercase mb-1">Successfull Transactions</div>
        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($successful_transactions) }}</div>
        <div class="mt-2 mb-0 text-muted text-xs">
         <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> {{ number_format((count($successful_transactions)/count($all_transactions)) * 100, 2) }}%</span>
         <span>Transaction that are completed</span>
      </div>
   </div>
   <div class="col-auto">
      <i class="fas fa-list-alt fa-2x text-primary"></i>
  </div>
</div>
</div>
</div>
</div>
<!-- New User Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
   <div class="card h-100">
     <div class="card-body">
      <div class="row no-gutters align-items-center">
       <div class="col mr-2">
        <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Transactions</div>
        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ count($pending_transactions) }}</div>
        <div class="mt-2 mb-0 text-muted text-xs">
         <span class="text-warning mr-2"><i class="fas fa-arrow-up"></i> {{ number_format((count($pending_transactions)/count($all_transactions)) * 100, 2) }}%</span>
         <span>Transactions that needs Admin review</span>
      </div>
   </div>
   <div class="col-auto">
      <i class="fas fa-list-alt fa-2x text-primary"></i>
  </div>
</div>
</div>
</div>
</div>
<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
   <div class="card h-100">
     <div class="card-body">
      <div class="row no-gutters align-items-center">
       <div class="col mr-2">
        <div class="text-xs font-weight-bold text-uppercase mb-1">Failed Transactions</div>
        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($failed_transactions) }}</div>
        <div class="mt-2 mb-0 text-muted text-xs">
         <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> {{ number_format((count($failed_transactions)/count($all_transactions)) * 100, 2) }}%</span>
         <span>Transactions that failed</span>
      </div>
   </div>
   <div class="col-auto">
      <i class="fas fa-list-alt fa-2x text-primary"></i>
  </div>
</div>
</div>
</div>
</div>

<div class="col-md-6">
   <div class="alert alert-info " role="alert">
     <h6><i class="fas fa-users"></i> Category in View:<b class="text-danger"> {{ $transactions['cat'] }} Transactions</b></h6>
     The category of Users currently in View
   </div>
</div>
<div class="col-md-6">
   <form method="GET" action="{{ route('admin.transaction.index') }}" id="transaction_listing">
      <div class="form-group">
         <label class="control-label col-md-5 col-sm-5 col-xs-12">Select Category:</label>
         <div class="col-md-12 col-sm-12 col-xs-12">
            <select name="type" class="form-control" id="user_type" onchange="event.preventDefault();  document.getElementById('transaction_listing').submit();">
               <option value="" selected="" disabled="">select category</option>
               <option value="all">All Transactions</option>
               <option value="success">Successfull</option>
               <option value="pending">Pending</option>
               <option value="failed">Failed</option>
               <option value="canceled">Cancelled</option>
            </select>
         </div>
      </div>
   </form>
</div>

<!-- DataTable with Hover -->
<div class="col-lg-12">
   <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
         <h6 class="m-0 font-weight-bold text-primary">All Transactions Listing</h6>
      </div>
      <div class="table-responsive p-3" style="font-size: 13px;">
         <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
               <tr>
                  <th>#</th>
                  <th>Ref. ID.</th>
                  <th>Amount</th>
                  <th>Type</th>
                  <th>Status</th>
                  <th>Created At</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tfoot>
               <tr>
                  <th>#</th>
                  <th>Ref. ID.</th>
                  <th>Amount</th>
                  <th>Type</th>
                  <th>Status</th>
                  <th>Created At</th>
                  <th>Actions</th>
               </tr>
            </tfoot>
            <tbody>
               @forelse($transactions['transactions'] as $transaction)
                  <tr>
                     <td>{{ $loop->iteration }}</td>
                     <td>{{ $transaction->reference }}</td>
                     <td>{{ $transaction->amount }}</td>
                     <td>
                        @if($transaction->type == 'wallet_recharge')
                            <span class="badge badge-success">{{ __('Wallet Deposit') }}</span>
                        @else
                            <span class="badge badge-danger"> {{ __('Spending') }}</span>
                        @endif
                     </td>
                     <td>
                        @if($transaction->status == 'success')
                            <span class="badge badge-success">{{ __('success') }}</span>
                        @elseif($transaction->status == 'pending')
                            <span class="badge badge-warning"> {{ __('pending') }}</span>
                        @elseif($transaction->status == 'failed')
                            <span class="badge badge-danger"> {{ __('failed') }}</span>
                        @elseif($transaction->status == 'canceled')
                            <span class="badge badge-warning"> {{ __('canceled') }}</span>
                        @endif
                     </td>
                     <td>{{ $transaction->created_at->diffForHumans() }}</td>
                     <td>
                        <a href="{{ route('admin.transaction.show', ['transaction' => $transaction->id]) }}" class="btn btn-sm btn-success" title='View'>
                           <i class="fa fa-eye"></i>
                        </a>

                        <a href="#" class="btn btn-sm btn-danger" title='Delete' rel="" onclick="deletTransaction('{{ route('admin.transaction.delete', ['transaction' => $transaction->id]) }}')">
                           <i class="fa fa-trash"></i>
                        </a>
                     </td>
                  </tr>
               @empty


               @endforelse
            </tbody>
         </table>
      </div>
   </div>
</div>


      {{-- Delete Transaction Modal  --}}
      <div class="modal fade modal_delete_transaction" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">DELETE TRANSACTION HISTORY</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
              <form method="post" action="" id="edit_url">
                  <p class="text-danger">Selecting Yes will make this transaction record to be removed completely out of the system.</p>
                  <p>Are you Sure to Delete?</p>
                  <button type="button" class="btn btn-danger" id="yes_delete_transaction">Yes</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              </form>  
            </div>
            <div class="modal-footer text-center">
              <p class="fs12">Deleting Resources</p>
            </div>
          </div>
        </div>
      </div>

@endsection


@section('more_scripts')
   <!-- Page level plugins -->
  <script src="{{ asset('admin_assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

  <script type="text/javascript">

      function deletTransaction(route) {
         $('.modal_delete_transaction').modal({show: true});
         $('#yes_delete_transaction').click(function(){
             window.location.href = route;
         })
      }
       
   </script>
@endsection
