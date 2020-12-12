@extends('admin.layout.auth_master')

@section('page_title', 'Admin User Management')

@section('more_css')
{{-- More CSS here --}}
   <link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">   

@endsection

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">User Profile</h1>
   <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">All Users</a></li>
      <li class="breadcrumb-item active" aria-current="page">Profile</li>
   </ol>
</div>


<div class="container register">
  <div class="row">
      <div class="col-md-3 register-left">
          <img src="{{ asset('admin_assets/img/boy.png') }}" alt="profile_image"/>
          <h3>{{ $user->fullname }}</h3>
          <p>Abut User Information not available!</p>
          <br>
          <p>Joined Since: {{ $user->created_at->diffForHumans() }}</p>
          
          @if($user->status == 'active')
              <span class="badge badge-success" style="font-size: 20px">{{ __('Active') }}</span>
          @elseif($user->status == 'inactive')
              <span class="badge badge-warning" style="font-size: 20px"> {{ __('Inactive') }}</span>
          @elseif($user->status == 'suspended')
              <span class="badge badge-danger" style="font-size: 20px"> {{ __('Suspended') }}</span>
          @endif
      </div>
      <div class="col-md-9 register-right">
          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
              <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Full Info</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Wallet Info</a>
              </li>
          </ul>
          <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <h3 class="register-heading">{{ $user->fullname }} Profile</h3>
                  <div class="row register-form pt-5">
                      <div class="col-md-7 table-responsive">
                          <table class="table table-bordered align-items-center table-flush" style="font-size: 12px;">
                            <tbody>
                              <tr>
                                <th colspan="2" class="text-info">Basic Info</th>
                              </tr>
                              <tr>
                                <td>Name</td>
                                <td>{{ $user->fullname }}</td>
                              </tr>
                              <tr>
                                <td>Special ID</td>
                                <td>{{ $user->user_id }}</td>
                              </tr>
                              <tr>
                                <td>Phone Number</td>
                                <td>{{ $user->phone_number }}</td>
                              </tr>
                              <tr>
                                <td>Email</td>
                                <td>{{ $user->email }}</td>
                              </tr>
                              <tr>
                                <th colspan="2" class="text-info">Bank Account Info</th>
                              </tr>
                              @if($user->userdata)
                                <tr>
                                  <td>Bank Account Name</td>
                                  <td>{{ $user->userdata->bank_account_name }}</td>
                                </tr>
                                <tr>
                                  <td>Bank Account No.</td>
                                  <td>{{ $user->userdata->bank_account_number }}</td>
                                </tr>
                                <tr>
                                  <td>Bank Account Type</td>
                                  <td>{{ $user->userdata->bank_account_type }}</td>
                                </tr>
                              @else
                                <tr>
                                  <th colspan="2" class=""><em>User added none yet</em></th>
                                </tr>
                              @endif  
                            </tbody>
                          </table>

                      </div>
                      <div class="col-md-5 mt-5">
                        <div class="card mb-4">
                          <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Action Center</h6>
                          </div>
                          <div class="card-body">
                            <p><code>Manage User Info</code>
                            </p>
                            <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#modal_edit" id="#modalEditButton">
                              <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                              </span>
                              <span class="text" >Edit User Account</span>
                            </a>
                            <div class="my-2"></div>
                            
                            @if($user->status == 'active')
                                <a href="{{ route('admin.users.change_status', ['user' => $user->id, 'status' => 'inactive']) }}" class="btn btn-warning btn-icon-split">
                                  <span class="icon text-white-50">
                                    <i class="fas fa-exclamation-triangle"></i>
                                  </span>
                                  <span class="text">Turn Inactive</span>
                                </a>
                                <div class="my-2"></div>
                                <a href="{{ route('admin.users.change_status', ['user' => $user->id, 'status' => 'suspended']) }}" class="btn btn-secondary btn-icon-split">
                                  <span class="icon text-white-50">
                                    <i class="fas fa-times"></i>
                                  </span>
                                  <span class="text">Suspend User</span>
                                </a>
                                <div class="my-2"></div>
                            @elseif($user->status == 'inactive')
                                <a href="{{ route('admin.users.change_status', ['user' => $user->id, 'status' => 'active']) }}" class="btn btn-success btn-icon-split">
                                  <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                  </span>
                                  <span class="text">Turn Active</span>
                                </a>
                                <div class="my-2"></div>
                                <a href="{{ route('admin.users.change_status', ['user' => $user->id, 'status' => 'suspended']) }}" class="btn btn-secondary btn-icon-split">
                                  <span class="icon text-white-50">
                                    <i class="fas fa-times"></i>
                                  </span>
                                  <span class="text">Suspend User</span>
                                </a>
                                <div class="my-2"></div>
                            @elseif($user->status == 'suspended')
                                <a href="{{ route('admin.users.change_status', ['user' => $user->id, 'status' => 'active']) }}" class="btn btn-success btn-icon-split">
                                  <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                  </span>
                                  <span class="text">Turn Active</span>
                                </a>
                                <div class="my-2"></div>

                                <a href="{{ route('admin.users.change_status', ['user' => $user->id, 'status' => 'inactive']) }}" class="btn btn-warning btn-icon-split">
                                  <span class="icon text-white-50">
                                    <i class="fas fa-exclamation-triangle"></i>
                                  </span>
                                  <span class="text">Turn Inactive</span>
                                </a>
                                <div class="my-2"></div>
                            @endif
                            
                            <a href="#" class="btn btn-danger btn-icon-split" onclick="delet({{ $user->id }}, '{{ route('admin.user.delete', ['user' => $user->id]) }}')">
                              <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                              </span>
                              <span class="text">Delete User Account</span>
                            </a>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                                      <th>Type</th>
                                      {{-- <th>Narration</th> --}}
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
                                         <td>{{ $transaction->amount }}</td>
                                         <td>
                                            @if($transaction->type == 'wallet_recharge')
                                                <span class="badge badge-success">{{ __('Wallet Deposit') }}</span>
                                            @else
                                                <span class="badge badge-danger"> {{ __('Spending') }}</span>
                                            @endif
                                         </td>
                                         {{-- <td>{{ $transaction->narration }}</td> --}}
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
                  </div>
              </div>
          </div>
      </div>
  </div>

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

      <!-- Modal Edit -->
      <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">EDIT USER ACCOUNT</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="" method="POST" action="{{ route('admin.user.update', ['user' => $user->id]) }}">
                @csrf
                <div class="row register-form">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>First Name</label>
                          <input name="firstname" type="text" class="form-control" placeholder="First Name *" required="" value="{{ $user->firstname }}" />
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input name="lastname" type="text" class="form-control" placehlder="Last Name *" required="" value="{{ $user->lastname }}" />
                      </div>
                      <div class="form-group">
                          <label>Email Address</label>
                          <input name="email" type="email" class="form-control" placehlder="Email *" required="" value="{{ $user->email }}" />
                      </div>

                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Phone Number</label>
                          <input name="phone_number" type="number" minlength="11" maxlength="11" class="form-control" placehlder="Phone Number *" required="" value="{{ $user->phone_number }}" />
                      </div>
                      @if($user->userdata)
                        <div class="form-group">
                          <label>Ethereum Wallet</label>
                          <input name="eth_address" type="text" class="form-control" placeholder="Ethereum Address *" required="" value="{{ $user->userdata->eth_address ?? '' }}" />
                        </div>
                        <div class="form-group">
                            <label>Bitcoin Wallet</label>
                            <input name="btc_address" type="text" class="form-control" placeholder="BTC Address *" required="" value="{{ $user->userdata->btc_address ?? '' }}" />
                        </div>
                      @endif
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>

              </form>
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

      function delet(id, route) {
         $('.modal_delete').modal({show: true});
         $('#yes_delete').click(function(){
             window.location.href = route;
         })
      }

      function deletTransaction(route) {
         $('.modal_delete_transaction').modal({show: true});
         $('#yes_delete_transaction').click(function(){
             window.location.href = route;
         })
      }
       
   </script>
@endsection
