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
   <h1 class="h3 mb-0 text-gray-800">User Virtual Cards</h1>
   <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">All Users</a></li>
      <li class="breadcrumb-item active" aria-current="page">Virtual Cards</li>
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
            <h4 class="text-5 font-weight-400 d-flex align-items-center mb-4">Virtual Cards
            </h4>
            <hr class="mx-n4 mb-4">
              
              <div class="row">

                @forelse($user->vcards as $vcard)
                <div class="col-md-6">    
                  <div class="container z-1 position-relative text-white">
                            
                        @if($vcard->card_type == 'visa')

                          <div class="card bg-gradient-primary shadow mt-4 h-200">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-12">
                                    <img src="{{ asset('assets/img/visa-logos.png') }}" alt="">
                                    <h4 class="mt-1 font-weight-normal"># {{ number_format($vcard->balance,2) }} 
                                      <a href="{{ route('admin.vcard.show', ['vcard' => $vcard->id]) }}" class="mt-1 font-weight-normal"><span class="float-right text-white" style="font-size: 12px">View Details</span></a></h4>
                                    
                                </div>
                                <div class="col-12 mt-5">
                                    <h3 class="font-weight-normal">{{ $vcard->masked_pan }}</h3>
                                </div>
                                <div class="col-12">
                                    <p>{{ $vcard->name_on_card }} <span class="float-right">{{ $vcard->expiration }}</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        @elseif($vcard->card_type == 'mastercard')

                          <div class="card bg-gradient-danger shadow mt-4 h-200">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-12 pb-0">
                                    <img src="{{ asset('assets/img/master_card.png') }}" alt="" class="mb-0 mt-0">
                                    <h4 class="mt-0 font-weight-normal"># {{ number_format($vcard->balance,2) }}
                                      <a href="{{ route('admin.vcard.show', ['vcard' => $vcard->id]) }}" class="mt-1 font-weight-normal"><span class="float-right text-white" style="font-size: 12px">View Details</span></a></h4>
                                    
                                </div>
                                <div class="col-12 mt-3">
                                    <h3 class="font-weight-normal">{{ $vcard->masked_pan }}</h3>
                                </div>
                                <div class="col-12">
                                    <p>{{ $vcard->name_on_card }} <span class="float-right">{{ $vcard->expiration }}</span></p>
                                </div>
                              </div>

                            </div>
                          </div>
                        @else

                          <div class="card bg-gradient-secondary shadow mt-4 h-200">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-12">
                                    <h3>{{ $vcard->card_type }}</h3>
                                    <h4 class="mt-1 font-weight-normal"># {{ number_format($vcard->balance,2) }} 
                                      <a href="{{ route('admin.vcard.show', ['vcard' => $vcard->id]) }}" class="mt-1 font-weight-normal"><span class="float-right text-white" style="font-size: 12px">View Details</span></a></h4>
                                    
                                </div>
                                <div class="col-12 mt-5">
                                    <h3 class="font-weight-normal">{{ $vcard->masked_pan }}</h3>
                                </div>
                                <div class="col-12">
                                    <p>{{ $vcard->name_on_card }} <span class="float-right">{{ $vcard->expiration }}</span></p>
                                </div>
                              </div>
                            </div>
                          </div>

                        @endif

                  </div>
                </div>

                @empty

                <div class="alert alert-info">
                  <i class="fa fa-exclamation-triangle"></i> User has no Virtual Card connected to him
                </div>


                @endforelse

                

                
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

      function deletTransaction(id, route) {
         $('.modal_delete').modal({show: true});
         $('#yes_delete').click(function(){
             window.location.href = route;
         })
      }
       
   </script>
@endsection
