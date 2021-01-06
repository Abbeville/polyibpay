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
   <h1 class="h3 mb-0 text-gray-800">User Virtual Card</h1>
   <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">All Virtual Cards</a></li>
      <li class="breadcrumb-item active" aria-current="page">Virtual Cards</li>
   </ol>
</div>




      <div class="row mt-3"> 
        
        <!-- Left Panel
        ============================================= -->
        <aside class="col-lg-3"> 
          
          <!-- Profile Details
          =============================== -->
          <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
            <div class="profile-thumb mt-3 mb-4"> 
              @if(!is_null($vcard->user->userdata))
                @if($vcard->user->userdata->photo == null)
                  <img class="rounded-circle" width="50%" src="{{ asset('admin_assets/img/boy.png') }}" alt="profile_image">
                @else
                  <img class="rounded-circle" width="50%" src="{{ asset($vcard->user->userdata->photo_url . '/' . $vcard->user->userdata->photo ) }}" alt="profile_image">
                @endif
              @else
                <img class="rounded-circle" width="50%" src="{{ asset('admin_assets/img/boy.png') }}" alt="profile_image">
              @endif
            </div>
            <p class="text-3 font-weight-500 mb-2">{{ $vcard->user->fullname }}</p>
              @if($vcard->user->status == 'active')
                <p class=" text-3">Status: <span class="bg-success text-white rounded-pill d-inline-block px-2 mb-0"><i class="fas fa-check-circle"></i> Active</span></p>
              @elseif($vcard->user->status == 'inactive')
                <p class="text-3">Status: <span class="bg-warning text-white rounded-pill d-inline-block px-2 mb-0"><i class="fas fa-exclamation-triangle"></i> Inactive</span></p>
              @elseif($vcard->user->status == 'suspended')
                <p class="text-3">Status: <span class="bg-danger text-white rounded-pill d-inline-block px-2 mb-0"><i class="fas fa-times-circle"></i> Suspended</span></p>
              @endif
            <a href="{{ route('admin.user.show', [$vcard->user_id]) }}"><p>Full Owner's Info</p></a>
          </div>
          <!-- Profile Details End --> 
          
          <!-- Available Balance
          =============================== -->
          <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
            <div class=" text-light my-3" style="font-size: 50px"><i class="fas fa-wallet"></i></div>
            <h3 class="text-9 font-weight-400">{{ $vcard->currency_type ?? '' }} {{ number_format($online_card_info['amount'], 2) ?? ''}}</h3>
            <p class="mb-2 text-muted opacity-8">Available Balance</p>
            <hr class="mx-n3">
            <div class="d-flex text-gray-800">
              <a href="#wallet-withdrawal" data-toggle="modal" class="btn-link mr-auto text-gray-800">Withdraw</a> 
              <a href="#wallet-deposit" data-toggle="modal" class="btn-link ml-auto text-gray-800">Deposit</a>
            </div>

          </div>
          <!-- Available Balance End --> 

          <!-- Available Balance
          =============================== -->
          <div class="bg-white shadow-sm rounded  p-3 mb-4">
            <div class="list-group">
              <p  class="list-group-item list-group-item-action active">
                Actions
              </p>
              @if($online_card_info['is_active'])
              <a href="{{ route('admin.vcard.change_status', ['vcard' => $vcard->id, 'status' => 'block']) }}" class="list-group-item list-group-item-action list-group-item-warning">Block Card</a>
              @else
              <a href="{{ route('admin.vcard.change_status', ['vcard' => $vcard->id, 'status' => 'unblock']) }}" class="list-group-item list-group-item-action list-group-item-success">Unblock Card</a>
              @endif
              <a href="{{ route('admin.vcard.terminate', ['vcard' => $vcard->id]) }}" class="list-group-item list-group-item-action list-group-item-danger">Terminate Card </a>
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
            <h4 class="text-5 font-weight-400 d-flex align-items-center mb-4">Card Info
            </h4>
            <hr class="mx-n4 mb-4">
              
              <div class="row">
                <div class="col-md-6">
                  <p>Card ID:  {{ $online_card_info['id'] }}</p>
                  <p>Account ID:  {{ $online_card_info['account_id'] }}</p>
                  <p>Balance:  {{ $online_card_info['amount'] }}</p>
                  <p>Currency:  {{ $online_card_info['currency'] }}</p>
                  <p>Card Pan:  {{ $online_card_info['card_pan'] }}</p>
                  <p>Card CVV:  {{ $online_card_info['cvv'] }}</p>
                  <p>Card Expiry Date:  {{ $online_card_info['expiration'] }}</p>
                    @if($online_card_info['is_active'])
                      <p class=" text-3">Status: <span class="bg-success text-white rounded-pill d-inline-block px-2 mb-0"><i class="fas fa-check-circle"></i> Active</span></p>
                    @else
                      <p class="text-3">Status: <span class="bg-danger text-white rounded-pill d-inline-block px-2 mb-0"><i class="fas fa-exclamation-triangle"></i> Inactive</span></p>
                    @endif
                </div>
                <div class="col-md-6">
                  <p>Card Type:  {{ $online_card_info['card_type'] }}</p>
                  <p>Name on Card:  {{ $online_card_info['name_on_card'] }}</p>
                  <p>Holder's City:  {{ $online_card_info['city'] }}</p>
                  <p>Holder's State:  {{ $online_card_info['state'] }}</p>
                  <p>Holder's Home Add.:  {{ $online_card_info['address_1'] }}</p>
                  <p>Holder's Zip-Code.:  {{ $online_card_info['zip_code'] }}</p>
                  <p>Created At:  {{ date('d-m-Y', strtotime($online_card_info['created_at'])) }}</p>

                </div>

              </div>
            <br>
          </div>
          <!-- Edit Details Modal
          ================================== -->

          <!-- Personal Details
          ============================================= -->
          <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h4 class="text-5 font-weight-400 d-flex align-items-center mb-4">Virtual Cards Transactions
            </h4>
            <hr class="mx-n4 mb-4">
              
              <div class="row">

                @forelse($online_card_transactions as $transaction)
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      {{ $transaction['product'] }}
                    </div>
                    <div class="card-body">
                      <blockquote class="blockquote mb-0">
                        <div class="row">
                          <div class="col-md-5">
                            <p>Tranx ID: {{ $transaction['id'] }}</p>
                            <p>Amount: <b>{{ $transaction['amount'] }}</b></p>
                            <p>Fee: {{ $transaction['fee'] }}</p>
                            <p>Resp Code: {{ $transaction['response_code'] }}</p>
                            <p>Amt Confirmed: {{ $transaction['amount_confirmed'] }}</p>
                            <p>Indicator: {{ $transaction['indicator'] }}</p>
                            
                          </div>
                          <div class="col-md-7">
                            <p>Ref: {{ $transaction['reference'] }}</p>
                            <p>Gateway Ref: <b>{{ $transaction['gateway_reference'] }}</b></p>
                            <p>Narration: {{ $transaction['narration'] }}</p>
                            <p>Currency: {{ $transaction['currency'] }}</p>
                            <p>Status: {{ $transaction['status'] }}</p>
                            <p>Message: {{ $transaction['response_message'] }}</p>
                          </div>
                        </div>
                        <footer class="blockquote-footer">Occured on: <cite title="Source Title">{{ date('d-m-Y', strtotime($transaction['created_at'])) }}</cite></footer>
                      </blockquote>
                    </div>
                  </div>
                </div>
              
              @empty

                <div class="alert alert-info col-md-12">
                  No transaction occured on this card
                </div>

              @endforelse

              </div>
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
              <form id="wallet-deposit" method="post" action="{{ route('admin.vcard.deposit', $online_card_info['id']) }}">
                @csrf

                <p class="text-danger">You are about to add a certain amount to the current balance of the user wallet, Be careful, you are dealing with figures of money here</p>
                <div class="form-group">
                  <label for="amount">Amount to Deposit</label>
                  <div class="input-group">
                    <input type="number" value="" class="form-control" data-bv-field="" id="amount" required="" placeholder="Amount to deposit" name="amount">
                  </div>
                </div>
                <input type="hidden" name="debit_currency" value="NGN">
                <button class="btn btn-primary btn-block" type="submit">Make Deposit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Add Money to wallet End --> 

      <!-- Withdrawal Modal
      ================================== -->
      <div id="wallet-withdrawal" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-400">Wallet Withdrawal</h5>
              <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <div class="modal-body p-4">
              <form id="wallet-withdrawal" method="post" action="{{ route('admin.user.withdraw', $online_card_info['id']) }}">
                @csrf

                <p class="text-danger">You are about to debit certain amount from the current balance of the user wallet, Be careful, you are dealing with figures of money here</p>
                <div class="form-group">
                  <label for="amount">Amount to Withdraw</label>
                  <div class="input-group">
                    <input type="number" value="" class="form-control" data-bv-field="" id="amount" required="" placeholder="Amount to deposit" name="amount">
                  </div>
                </div>
                <input type="hidden" name="debit_currency" value="NGN">
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
