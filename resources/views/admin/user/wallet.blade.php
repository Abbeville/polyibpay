@extends('admin.layout.auth_master')

@section('page_title', 'Admin User Management')

@section('more_css')
{{-- More CSS here --}}
   <link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

   <style type="text/css">
    .text-2{
      font-size: 14px;
      color: green;
    }
   </style>

@endsection

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">User Wallet</h1>
   <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">All Users</a></li>
      <li class="breadcrumb-item active" aria-current="page">Transaction</li>
   </ol>
</div>


<div class="bg-primary">
  <div class="container d-flex justify-content-center ">
    <ul class="nav secondary-nav">
      <li class="nav-item"> <a class="nav-link active text-white" href="{{ route('admin.user.show', ['user' => $user->id]) }}">Account</a></li>
      <li class="nav-item"> <a class="nav-link text-white" href="{{ route('admin.user.wallet.show', ['user' => $user->id]) }}">Wallet</a></li>
      <li class="nav-item"> <a class="nav-link text-white" href="{{ route('admin.user.virtual_card.show', ['user' => $user->id]) }}">Virtual Cards</a></li>
    </ul>
  </div>
</div>


      <div class="row mt-3"> 
        
        <!-- Left Panel
        ============================================= -->
        <aside class="col-lg-3"> 
          
          <!-- Profile Details
          =============================== -->
          <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
            <div class="profile-thumb mt-3 mb-4"> 
              @if(!is_null($user->userdata))
                @if($user->userdata->photo == null)
                  <img class="rounded-circle" width="50%" src="{{ asset('admin_assets/img/boy.png') }}" alt="profile_image">
                @else
                  <img class="rounded-circle" width="50%" src="{{ asset($user->userdata->photo_url . '/' . $user->userdata->photo ) }}" alt="profile_image">
                @endif
              @else
                <img class="rounded-circle" width="50%" src="{{ asset('admin_assets/img/boy.png') }}" alt="profile_image">
              @endif
            </div>
            <p class="text-3 font-weight-500 mb-2">{{ $user->fullname }}</p>
            <p class="text-3 font-weight-500 mb-2">{{ $user->userdata->about ?? 'No about info set' }}</p>
              @if($user->status == 'active')
                <p class=" text-3">Status: <span class="bg-success text-white rounded-pill d-inline-block px-2 mb-0"><i class="fas fa-check-circle"></i> Active</span></p>
              @elseif($user->status == 'inactive')
                <p class="text-3">Status: <span class="bg-warning text-white rounded-pill d-inline-block px-2 mb-0"><i class="fas fa-exclamation-triangle"></i> Inactive</span></p>
              @elseif($user->status == 'suspended')
                <p class="text-3">Status: <span class="bg-danger text-white rounded-pill d-inline-block px-2 mb-0"><i class="fas fa-times-circle"></i> Suspended</span></p>
              @endif
          </div>
          <!-- Profile Details End --> 
          
          <!-- Available Balance
          =============================== -->
          <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
            <div class=" text-light my-3" style="font-size: 50px"><i class="fas fa-wallet"></i></div>
            <h3 class="text-9 font-weight-400">{{ $user->wallet->currency_type ?? '' }} {{ number_format($user->wallet->balance, 2) ?? 'Not yet Created'}}</h3>
            <p class="mb-2 text-muted opacity-8">Available Balance</p>
            <hr class="mx-n3">
            <div class="d-flex text-gray-800">
              <a href="#wallet-withdrawal" data-toggle="modal" class="btn-link mr-auto text-gray-800">Withdraw</a> 
              <a href="#wallet-deposit" data-toggle="modal" class="btn-link ml-auto text-gray-800">Deposit</a>
            </div>
          </div>
          <!-- Available Balance End --> 
          
        </aside>
        <!-- Left Panel End --> 
        
        <!-- Middle Panel
        ============================================= -->
        <div class="col-lg-9" style="font-size: 14px;"> 
          
          <!-- Personal Details
          ============================================= -->
          <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h4 class="text-5 font-weight-400 d-flex align-items-center mb-4">Wallet History
            </h4>
            <hr class="mx-n4 mb-4">
            
                    <div class="row register-form">
                           <!-- Earnings (Monthly) Card Example -->
                       <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card h-100 bg-success text-white">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Wallet Balance</div>
                                <div class="h5 mb-0 font-weight-bold">{{ $user->wallet->currency_type . ' ' . number_format($user->wallet->balance, 2) }}</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card h-100">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Deposits</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user->wallet->currency_type . ' ' . number_format($user->wallet->credit, 2) }}</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card h-100 bg-danger text-white">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Amount Spent</div>
                                <div class="h5 mb-0 font-weight-bold text-white">{{ $user->wallet->currency_type . ' ' . number_format($user->wallet->debit, 2) }}</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="col-lg-12">
                       <div class="card mb-4">
                          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                             <h6 class="m-0 font-weight-bold text-primary">Wallet Transactions</h6>
                          </div>
                          <div class="table-responsive fs12 px-3 pb-2">
                             <table class="table align-items-center table-flush table-hover " id="dataTableHover">
                                <thead class="thead-light">
                                   <tr>
                                      <th>#</th>
                                      {{-- <th>Ref. ID.</th> --}}
                                      <th>Amount</th>
                                      {{-- <th>Trans. Cat</th> --}}
                                      <th>Narration</th>
                                      <th>Status</th>
                                      <th>Created At</th>
                                      <th>Actions</th>
                                   </tr>
                                </thead>

                                <tbody>
                                   @forelse($user->transactions as $transaction)
                                      <tr>
                                         <td>{{ $loop->iteration }}</td>
                                         {{-- <td>{{ $transaction->reference }}</td> --}}
                                         <td>
                                            @if($transaction->type == 'credit')
                                                <p class="text-success">{{ $transaction->amount }}</p>
                                                <p class="">Cat.: {{ $transaction->category }}</p>
                                            @else
                                                <p class="text-danger"> {{ $transaction->amount }}</p>
                                            @endif
                                         </td>
                                         {{-- <td>{{ $transaction->category }}</td> --}}
                                         <td>{{ $transaction->narration }}</td>
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
                                            <a href="{{ route('admin.transaction.show', ['transaction' => $transaction->id, 'back' => 1]) }}" class="btn btn-sm btn-success" title='View'>
                                               <i class="fa fa-eye"></i>
                                            </a>

                                            <a href="#" class="btn btn-sm btn-danger" title='Delete' rel="" onclick="deletTransaction('{{ route('admin.transaction.delete', ['transaction' => $transaction->id, 'back' => 1]) }}')">
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
                  </div>


            <br>
            <br>
          </div>
          <!-- Edit Details Modal
          ================================== -->
          
          
        </div>
        <!-- Middle Panel End --> 
      </div>



      <!-- Deposit Modal
      ================================== -->
      <div id="wallet-deposit" class="modal fade " role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-400">Wallet Deposit</h5>
              <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <div class="modal-body p-4">
              <form id="wallet-deposit" method="post" action="{{ route('admin.user.wallet_deposit', ['user' => $user->id]) }}">
                @csrf

                <p class="text-danger">You are about to add a certain amount to the current balance of the user wallet, Be careful, you are dealing with figures of money here</p>
                <div class="form-group">
                  <label for="amount">Amount to Deposit</label>
                  <div class="input-group">
                    <input type="number" value="" class="form-control" data-bv-field="" id="amount" required="" placeholder="Amount to deposit" name="deposit_amount">
                  </div>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Make Deposit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Add Money to wallet End --> 

      <!-- Withdrawal Modal
      ================================== -->
      <div id="wallet-withdrawal" class="modal fade " role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-400">Wallet Withdrawal</h5>
              <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <div class="modal-body p-4">
              <form id="wallet-withdrawal" method="post" action="{{ route('admin.user.wallet_withdrawal', ['user' => $user->id]) }}">
                @csrf

                <p class="text-danger">You are about to debit certain amount from the current balance of the user wallet, Be careful, you are dealing with figures of money here</p>
                <div class="form-group">
                  <label for="amount">Amount to Withdraw</label>
                  <div class="input-group">
                    <input type="number" value="" class="form-control" data-bv-field="" id="amount" required="" placeholder="Amount to deposit" name="withdrawal_amount">
                  </div>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Make Withdrawal</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Remove Money from wallet End --> 



      {{-- Delete User Modal  --}}
      <div class="modal fade modal_delete" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">DELETE USER</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
              <form method="post" action="" id="edit_url">
                  <p class="text-danger">Selecting Yes will make this transaction record be removed from the system with all related records</p>
                  <p>Are you Sure to Delete?</p>
                  <button type="button" class="btn btn-danger" id="yes_delete">Yes</button>
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
         $('.modal_delete').modal({show: true});
         $('#yes_delete').click(function(){
             window.location.href = route;
         })
      }
       
   </script>
@endsection
