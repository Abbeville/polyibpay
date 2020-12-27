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
   <h1 class="h3 mb-0 text-gray-800">User Account</h1>
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
            <h4 class="text-5 font-weight-400 d-flex align-items-center mb-4">Personal Details
              <a href="#edit-personal-details" data-toggle="modal" class="ml-auto text-2 text-uppercase btn-link"><span class="mr-1"><i class="fas fa-edit"></i></span>Edit</a>
            </h4>
            <hr class="mx-n4 mb-4">
            <div class="form-row align-items-center">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Name:</p>
              <p class="col-sm-9 text-3">{{ $user->fullname }}</p>
            </div>
            <div class="form-row align-items-center">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Email:</p>
              <p class="col-sm-9 text-3">{{ $user->email}}</p>
            </div>
            <div class="form-row align-items-center">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Phone Number:</p>
              <p class="col-sm-9 text-3">{{ $user->phone_number}}</p>
            </div>
            <div class="form-row align-items-center">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Date of Birth:</p>
              <p class="col-sm-9 text-3">{{ $user->userdata->dob ?? 'Not set yet' }}</p>
            </div>
            <div class="form-row align-items-center">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Joined Since:</p>
              <p class="col-sm-9 text-3">{{ $user->created_at->diffForHumans() }}</p>
            </div>
            <div class="form-row align-items-baseline">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Address:</p>
              <p class="col-sm-9 text-3">{{ $user->userdata->address ?? 'Not Yet Set' }},
                <br>
                {{ $user->userdata->state ?? 'Not Yet Set'}},<br>
                {{ $user->userdata->city ?? 'Not Yet Set' }} - {{ $user->userdata->zip_code ?? 'Not Yet Set'}},<br>
                {{ $user->userdata->country ?? 'Not Yet Set'}}.</p>
            </div>
           
            <div class="form-row mb-3" style="float: right;">

              @if($user->status == 'active')
                  <a href="{{ route('admin.users.change_status', ['user' => $user->id, 'status' => 'inactive']) }}" class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    <span class="text">Turn Inactive</span>
                  </a>
                  <div class="my-2 mr-2"></div>
                  <a href="{{ route('admin.users.change_status', ['user' => $user->id, 'status' => 'suspended']) }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-times"></i>
                    </span>
                    <span class="text">Suspend User</span>
                  </a>
                  <div class="my-2 mr-2"></div>
              @elseif($user->status == 'inactive')
                  <a href="{{ route('admin.users.change_status', ['user' => $user->id, 'status' => 'active']) }}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Turn Active</span>
                  </a>
                  <div class="my-2 mr-2"></div>
                  <a href="{{ route('admin.users.change_status', ['user' => $user->id, 'status' => 'suspended']) }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-times"></i>
                    </span>
                    <span class="text">Suspend User</span>
                  </a>
                  <div class="my-2 mr-2"></div>
              @elseif($user->status == 'suspended')
                  <a href="{{ route('admin.users.change_status', ['user' => $user->id, 'status' => 'active']) }}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Turn Active</span>
                  </a>
                  <div class="my-2 mr-2"></div>

                  <a href="{{ route('admin.users.change_status', ['user' => $user->id, 'status' => 'inactive']) }}" class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    <span class="text">Turn Inactive</span>
                  </a>
                  <div class="my-2 mr-2"></div>
              @endif

              <a href="#" class="btn btn-danger btn-icon-split" onclick="delet({{ $user->id }}, '{{ route('admin.user.delete', ['user' => $user->id]) }}')">
                <span class="icon text-white-50">
                  <i class="fas fa-trash"></i>
                </span>
                <span class="text">Delete User Account</span>
              </a>

            </div>
            <br>
            <br>
          </div>
          <!-- Edit Details Modal
          ================================== -->
          <div id="edit-personal-details" class="modal fade " role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title font-weight-400">Personal Details</h5>
                  <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body p-4">
                  <form id="personaldetails" method="post" action="{{ route('admin.user.update', ['user' => $user->id]) }}">
                    @csrf
                    <input type="hidden" name="detail" value="personaldetails">
                    <div class="row">
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="firstName">First Name</label>
                          <input type="text" value="{{ $user->firstname ?? '' }}" class="form-control" data-bv-field="firstName" id="firstName" required="" placeholder="First Name" name="firstname">
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="fullName">Last Name</label>
                          <input type="text" value="{{ $user->lastname }}" class="form-control" data-bv-field="fullName" id="fullName" required="" placeholder="Full Name" name="lastname">
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="fullName">Email</label>
                          <input type="email" value="{{ $user->email }}" class="form-control" data-bv-field="fullName" id="fullName" required="" placeholder="Email" name="email">
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="fullName">Phone Number</label>
                          <input type="number" value="{{ $user->phone_number }}" class="form-control" data-bv-field="fullName" id="fullName" required="" placeholder="Phone Number" name="phone_number">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="birthDate">Date of Birth</label>
                          <div class="position-relative">
                            <input id="birthDate" value="{{ $user->userdata->dob ?? ''}}" type="date" class="form-control" required="" placeholder="Date of Birth" name="dob">
                           </div>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="birthDate">About</label>
                          <div class="position-relative">
                            <input id="birthDate" value="{{ $user->userdata->about ?? ''}}" type="text" class="form-control" required="" placeholder="About you" name="about">
                           </div>
                        </div>
                      </div>
                      <div class="col-12">
                        <h5 class="text-5 font-weight-400 mt-3">Address</h5>
                        <hr>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="address">Address</label>
                          <input type="text" value="{{ $user->userdata->address ?? '' }}" class="form-control" data-bv-field="address" id="address" required="" placeholder="Address 1" name="address">
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="city">City</label>
                          <input id="city" value="{{ $user->userdata->city ?? '' }}" type="text" class="form-control" required="" placeholder="City" name="city">
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="input-zone">State</label>
                          <select class="custom-select" id="input-zone" name="state">
                            <option value="" selected="" disabled=""> --- Please Select --- </option>
                            @forelse($states = getStates() as $state)

                              <option value="{{ $state->name }}" 
                                @if($user->userdata)
                                @if($user->userdata->state != null && $user->userdata->state == $state->name)
                                selected=""
                                @endif 
                                @endif 
                                >
                                {{ $state->name }}
                              </option>
                            @empty

                            @endforelse
                          </select>
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="zipCode">Zip Code</label>
                          <input id="zipCode" value="{{ $user->userdata->zip_code ?? '' }}" type="text" class="form-control" required="" placeholder="Zip Code" name="zip_code">
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="form-group">
                          <label for="inputCountry">Country</label>
                          <select class="custom-select" id="inputCountry" name="country_id" required="">
                              <option value="Nigeria" selected="">Nigeria</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-block mt-2" type="submit">Save Changes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Personal Details End --> 
          
          
          <!-- Email Addresses
          ============================================= -->
          <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h5 class="text-5 font-weight-400 d-flex align-items-center mb-4">Bank Details<a href="#edit-email" data-toggle="modal" class="ml-auto text-2 text-uppercase btn-link"><span class="mr-1"><i class="fas fa-edit"></i></span>Edit</a></h5>
            <hr class="mx-n4 mb-4">
            <div class="form-row align-items-center">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Bank Name:</p>
              <p class="col-sm-9 text-3">{{ (getBank($user->userdata->bank_name_id ?? 0)->bank_name ?? 'Unknown') ?? 'Not set yet' }}</p>
            </div>
            <div class="form-row align-items-center">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Bank Account Name</p>
              <p class="col-sm-9 text-3">{{ $user->userdata->bank_account_name ?? 'Not set yet' }}</p>
            </div>
            <div class="form-row align-items-center">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Bank Account Number</p>
              <p class="col-sm-9 text-3">{{ $user->userdata->bank_account_number ?? 'Not set yet' }}</p>
            </div>
            <div class="form-row align-items-center">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Bank Account Type</p>
              <p class="col-sm-9 text-3">{{ $user->userdata->bank_account_type ?? 'Not set yet' }}</p>
            </div>
          </div>
          <!-- Edit Details Modal
          ================================== -->
          <div id="edit-email" class="modal fade " role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title font-weight-400">Bank Details</h5>
                  <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body p-4">
                  <form id="bank_info" method="post" action="{{ route('admin.user.update', ['user' => $user->id]) }}">
                    @csrf
                    <input type="hidden" name="detail" value="bankdetails">
                    <div class="form-group">
                      <label for="input-zone">Bank Name</label>
                      <select class="custom-select" id="input-zone" name="bank_name_id" required="">
                        <option value="" selected="" disabled=""> --- Please Select --- </option>
                        @forelse($banks = getAllBanks() as $bank)

                          <option value="{{ $bank->code }}" 
                            @if($user->userdata)
                            @if($user->userdata->bank_name_id != null && $user->userdata->bank_name_id == $bank->code)
                            selected=""
                            @endif 
                            @endif 
                            >
                            {{ $bank->bank_name }}
                          </option>
                        @empty

                        @endforelse
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="emailID2">Bank Account Name</label>
                      <div class="input-group">
                        <input type="text" value="{{ $user->userdata->bank_account_name ?? '' }}" class="form-control" data-bv-field="" id="emailID2" required="" placeholder="Account Name" name="bank_account_name">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="emailID2">Bank Account Number</label>
                      <div class="input-group">
                        <input type="text" value="{{ $user->userdata->bank_account_number ?? '' }}" class="form-control" data-bv-field="" id="emailID2" required="" placeholder="Account Number" name="bank_account_number">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="input-zone">Bank Account Type</label>
                      <select class="custom-select" id="input-zone" name="bank_account_type" required="">
                        <option value="" selected="" disabled=""> --- Please Select --- </option>

                          <option value="savings" 
                            @if($user->userdata)
                            @if($user->userdata->bank_account_type != null && $user->userdata->bank_account_type == 'savings')
                            selected=""
                            @endif 
                            @endif 
                            >Savings
                          </option>
                          <option value="current" 
                            @if($user->userdata)
                            @if($user->userdata->bank_account_type != null && $user->userdata->bank_account_type == 'current')
                            selected=""
                            @endif 
                            @endif 
                            >Current
                          </option>
                      </select>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Save Changes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Email Addresses End --> 
          
          <!-- Phone
          ============================================= -->
          <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h5 class="text-5 font-weight-400 d-flex align-items-center mb-4">Crypto Wallets<a href="#edit-phone" data-toggle="modal" class="ml-auto text-2 text-uppercase btn-link"><span class="mr-1"><i class="fas fa-edit"></i></span>Edit</a></h5>
            <hr class="mx-n4 mb-4">
            <div class="form-row align-items-center">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">BTC Wallet Address:</p>
              <p class="col-sm-9 text-3 align-items-center d-flex">{{ $user->userdata->btc_address ?? 'Not set yet'}}</p>
            </div>
            <div class="form-row align-items-center">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Eth Wallet Address:</p>
              <p class="col-sm-9 text-3">{{ $user->userdata->eth_address ?? 'Not Set yet' }}</p>
            </div>
          </div>
          <!-- Edit Details Modal
          ================================== -->
          <div id="edit-phone" class="modal fade " role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title font-weight-400">Cryto Wallet Address</h5>
                  <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body p-4">
                  <form id="bank_info" method="post" action="{{ route('admin.user.update', ['user' => $user->id]) }}">
                    @csrf
                    <input type="hidden" name="detail" value="wallletsdetails">
                    <div class="form-group">
                      <label for="emailID2">BTC Address</label>
                      <div class="input-group">
                        <input type="text" value="{{ $user->userdata->btc_address ?? '' }}" class="form-control" data-bv-field="" id="emailID2" required="" placeholder="BTC Wallet Address" name="btc_address">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="emailID2">Eth Address</label>
                      <div class="input-group">
                        <input type="text" value="{{ $user->userdata->eth_address ?? '' }}" class="form-control" data-bv-field="" id="emailID2" required="" placeholder="ETH Wallet Address" name="eth_address">
                      </div>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Save Changes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Phone End --> 

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
          
        </div>
        <!-- Middle Panel End --> 
      </div>



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
                  <p class="text-danger">Selecting Yes will make all this user resources(Cards, Wallet, Bank Data etc) be removed compleetely in the system.</p>
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

  <script type="text/javascript">

      function delet(id, route) {
         $('.modal_delete').modal({show: true});
         $('#yes_delete').click(function(){
             window.location.href = route;
         })
      }
       
   </script>
@endsection
