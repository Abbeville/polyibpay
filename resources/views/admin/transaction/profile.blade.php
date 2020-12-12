@extends('admin.layout.auth_master')

@section('page_title', 'Admin Transaction Management')

@section('more_css')
{{-- More CSS here --}}
   <link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

   <style type="text/css">
     .register .nav-tabs{
          margin-top: 3%;
          border: none;
          background: #0062cc;
          border-radius: 1.5rem;
          width: 30%;
          float: right;
      }
      .register .nav-tabs .nav-link{
          padding: 2%;
          height: 34px;
          font-weight: 600;
          color: #fff;
          border-top-right-radius: 1.5rem;
          border-bottom-right-radius: 1.5rem;
      }

      .register .nav-tabs .nav-link.active{
          width: auto;
          color: #0062cc;
          border: 2px solid #0062cc;
          border-top-left-radius: 1.5rem;
          border-bottom-left-radius: 1.5rem;
      }
   </style>
@endsection

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Transaction (#{{ $transaction->reference }})</h1>
   <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.transaction.index') }}">All Transactions</a></li>
      <li class="breadcrumb-item active" aria-current="page">Transaction</li>
   </ol>
</div>


<div class="container register">
  <div class="row">
      <div class="col-md-3 register-left">
          {{-- <img src="{{ asset('admin_assets/img/boy.png') }}" alt="profile_image"/> --}}
          <i class="fa fa-wallet mb-4" style="font-size: 60px"></i>
          <h3>{{ __('NGN') }} {{ $transaction->amount }}</h3>
            @if($transaction->type == 'bills')
              Debited Amount
            @elseif($transaction->type == 'wallet_recharge')
              Credited Amount
            @endif
          <br>
          <br>
          <p>Happened Since: {{ $transaction->created_at->diffForHumans() }}</p>
          
          @if($transaction->status == 'success')
              <span class="badge badge-success" style="font-size: 20px">{{ __('Successful') }}</span>
          @elseif($transaction->status == 'pending')
              <span class="badge badge-warning" style="font-size: 20px"> {{ __('Pending') }}</span>
          @elseif($transaction->status == 'failed')
              <span class="badge badge-danger" style="font-size: 20px"> {{ __('Failed') }}</span>
          @endif
      </div>
      <div class="col-md-9 register-right">
          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
              <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">TRANSACTION HISTORY</a>
              </li>
          </ul>
          <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <h3 class="register-heading">
                    @if($transaction->type == 'bills')
                      Bill Payment

                    @elseif($transaction->type == 'wallet_recharge')
                      Received Payment
                    @endif
                  </h3>
                  <div class="row register-form pt-5">
                      <div class="col-md-7 table-responsive">
                          <table class="table table-bordered align-items-center table-flush" style="font-size: 13px;">
                            <tbody>
                              <tr>
                                <th colspan="2" class="text-info">Basic Info</th>
                              </tr>
                              <tr>
                                <td>Made by</td>
                                  <td>
                                    <a href="{{ route('admin.user.show', $transaction->user_id) }}">
                                      {{ $transaction->user->fullname }}
                                    </a>
                                  </td>
                              </tr>
                              <tr>
                                <td>Reference</td>
                                <td>{{ $transaction->reference }}</td>
                              </tr>
                              </tr>
                              <tr>
                                <td>Status</td>
                                <td>{{ $transaction->status }}</td>
                              </tr>
                              <tr>
                                <td>Happened On</td>
                                <td>{{ date('D, d-m-Y', strtotime($transaction->created_at)) }}</td>
                              </tr>
                              <tr>
                                <td>Description</td>
                                <td>{{ $transaction->narration }}
                              </td>
                              
                               
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
                              <span class="text" >Edit Transaction History</span>
                            </a>
                            <div class="my-2"></div>
                            
                            @if($transaction->status == 'success')
                                <a href="{{ route('admin.transaction.change_status', ['transaction' => $transaction->id, 'status' => 'pending']) }}" class="btn btn-warning btn-icon-split">
                                  <span class="icon text-white-50">
                                    <i class="fas fa-exclamation-triangle"></i>
                                  </span>
                                  <span class="text">Set As Pending</span>
                                </a>
                                <div class="my-2"></div>
                                <a href="{{ route('admin.transaction.change_status', ['transaction' => $transaction->id, 'status' => 'failed']) }}" class="btn btn-secondary btn-icon-split">
                                  <span class="icon text-white-50">
                                    <i class="fas fa-times"></i>
                                  </span>
                                  <span class="text">Set As Failed</span>
                                </a>
                                <div class="my-2"></div>
                            @elseif($transaction->status == 'pending')
                                <a href="{{ route('admin.transaction.change_status', ['transaction' => $transaction->id, 'status' => 'success']) }}" class="btn btn-success btn-icon-split">
                                  <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                  </span>
                                  <span class="text">Set As Successful</span>
                                </a>
                                <div class="my-2"></div>
                                <a href="{{ route('admin.transaction.change_status', ['transaction' => $transaction->id, 'status' => 'failed']) }}" class="btn btn-secondary btn-icon-split">
                                  <span class="icon text-white-50">
                                    <i class="fas fa-times"></i>
                                  </span>
                                  <span class="text">Set As Failed</span>
                                </a>
                                <div class="my-2"></div>
                            @elseif($transaction->status == 'failed')
                                <a href="{{ route('admin.transaction.change_status', ['transaction' => $transaction->id, 'status' => 'success']) }}" class="btn btn-success btn-icon-split">
                                  <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                  </span>
                                  <span class="text">Set As Successful</span>
                                </a>
                                <div class="my-2"></div>

                                <a href="{{ route('admin.transaction.change_status', ['transaction' => $transaction->id, 'status' => 'pending']) }}" class="btn btn-warning btn-icon-split">
                                  <span class="icon text-white-50">
                                    <i class="fas fa-exclamation-triangle"></i>
                                  </span>
                                  <span class="text">Set As pending</span>
                                </a>
                                <div class="my-2"></div>
                            @endif
                            
                            <a href="#" class="btn btn-danger btn-icon-split" onclick="delet('{{ route('admin.transaction.delete', ['transaction' => $transaction->id]) }}')">
                              <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                              </span>
                              <span class="text">Delete History</span>
                            </a>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="row register-form">
                      hewd
                  </div>
              </div>
          </div>
      </div>
  </div>

            {{-- </div> --}}

      {{-- Delete User Modal  --}}
      <div class="modal fade modal_delete" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                  <p class="text-danger">Selecting Yes will make this transaction record removed from the system</p>
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

      <!-- Modal Edit -->
      <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">EDIT TRANSACTION HISTORY</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="" method="POST" action="{{ route('admin.transaction.update', ['transaction' => $transaction->id]) }}">
                @csrf
                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Amount</label>
                          <input name="amount" type="number" class="form-control" placeholder="Transaction Amount *" required="" value="{{ $transaction->amount }}" />
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input name="description" type="text" class="form-control" placehlder="Narration *" required="" value="{{ $transaction->narration }}" />
                      </div>
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

      function delet(route) {
         $('.modal_delete').modal({show: true});
         $('#yes_delete').click(function(){
             window.location.href = route;
         })
      }
       
   </script>
@endsection
