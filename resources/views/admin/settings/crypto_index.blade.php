@extends('admin.layout.auth_master')

@section('page_title', 'Admin Settings')

@section('more_css')
{{-- More CSS here --}}
   <link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

   <style type="text/css">
    .text-2{
      font-size: 14px;
      color: green;
    }
    .text-5c{
      font-style: bolder;
      font-size: 18px;
      color: red;
    }
   </style>

@endsection

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Crypto Settings</h1>
   <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Crypto Settings</li>
   </ol>
</div>



<div class="row mt-3"> 
        
        <!-- Left Panel
        ============================================= -->
        <aside class="col-lg-3"> 
          
         
          
          <!-- Available Balance
          =============================== -->
          <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
            <div class=" text-light my-3" style="font-size: 50px"><i class="fas fa-wallet"></i></div>
            <h3 class="text-9 font-weight-400">BTC STATUS</h3>
            
              @if(config('global.btc_status')['value']  == 'active')
                <p class=" text-3">Status: <span class="bg-success text-white rounded-pill d-inline-block px-2 mb-0"><i class="fas fa-check-circle"></i> Active</span></p>
              @else
                <p class="text-3">Status: <span class="bg-warning text-white rounded-pill d-inline-block px-2 mb-0"><i class="fas fa-exclamation-triangle"></i> Inactive</span></p>
              @endif

            <hr class="mx-n3">
            <div class="d-flex text-gray-800">
              <p></p>
              @if(config('global.btc_status')['value']  == 'active')
                <a href="{{ route('admin.settings.crypto.status', ['status' => 'inactive', 'crypto' => 'btc']) }}" class="btn btn-warning"><i class="fas fa-exclamation-triangle"></i> Turn Inactive</a>
              @else
                <a href="{{ route('admin.settings.crypto.status', ['status' => 'active', 'crypto' => 'btc']) }}" class="btn btn-success"><i class="fas fa-check-circle"></i> Turn Active</a>
              @endif
            </div>
          </div>
          <!-- Available Balance End --> 

          <!-- Available Balance
          =============================== -->
          <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
            <div class=" text-light my-3" style="font-size: 50px"><i class="fas fa-wallet"></i></div>
            <h3 class="text-9 font-weight-400">ETHEREUM STATUS</h3>
            
              @if(config('global.eth_status')['value']  == 'active')
                <p class=" text-3">Status: <span class="bg-success text-white rounded-pill d-inline-block px-2 mb-0"><i class="fas fa-check-circle"></i> Active</span></p>
              @else
                <p class="text-3">Status: <span class="bg-warning text-white rounded-pill d-inline-block px-2 mb-0"><i class="fas fa-exclamation-triangle"></i> Inactive</span></p>
              @endif

            <hr class="mx-n3">
            <div class="d-flex text-gray-800">
              <p></p>
              @if(config('global.eth_status')['value']  == 'active')
                <a href="{{ route('admin.settings.crypto.status', ['status' => 'inactive', 'crypto' => 'eth']) }}" class="btn btn-warning"><i class="fas fa-exclamation-triangle"></i> Turn Inactive</a>
              @else
                <a href="{{ route('admin.settings.crypto.status', ['status' => 'active', 'crypto' => 'eth']) }}" class="btn btn-success"><i class="fas fa-check-circle"></i> Turn Active</a>
              @endif
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
            <h4 class="text-5 font-weight-400 d-flex align-items-center mb-4">BTC Details
              <a href="#edit-personal-details" data-toggle="modal" class="ml-auto text-2 text-uppercase btn-link"><span class="mr-1"><i class="fas fa-edit"></i></span>Edit</a>
            </h4>
            <hr class="mx-n4 mb-4">
            <div class="row align-items-center my-0 py-0">
              <p class="col-sm-3 text-muted text-sm-right my-0 mb-sm-3">Name:</p>
              <p class="col-sm-9 text-3">{{ config('global.btc_wallet_address')['name'] }}</p>
              <p class="col-sm-3 text-muted text-sm-right my-0 mb-sm-3">Value:</p>
              <p class="col-sm-9 text-5c">{{ config('global.btc_wallet_address')['value'] }}</p>
              <p class="col-sm-3 text-muted text-sm-right my-0 mb-sm-3">Description:</p>
              <p class="col-sm-9 text-3">{{ config('global.btc_wallet_address')['description'] }}</p>
            </div>
            <hr class="mx-n4 mb-4">

            <div class="row align-items-center my-0 py-0">
              <p class="col-sm-3 text-muted text-sm-right my-0 mb-sm-3">Name:</p>
              <p class="col-sm-9 text-3">{{ config('global.btc_rate')['name'] }}</p>
              <p class="col-sm-3 text-muted text-sm-right my-0 mb-sm-3">Value:</p>
              <p class="col-sm-9 text-5c">{{ config('global.btc_rate')['value'] }}</p>
              <p class="col-sm-3 text-muted text-sm-right my-0 mb-sm-3">Description:</p>
              <p class="col-sm-9 text-3">{{ config('global.btc_rate')['description'] }}</p>
            </div>
            
           
            
            <br>
          </div>
          <!-- Edit Details Modal
          ================================== -->

          <div id="edit-personal-details" class="modal fade " role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title font-weight-400">Edit BTC Details</h5>
                  <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body p-4">
                  <form id="personaldetails" method="post" action="{{ route('admin.settings.crypto.set_btc_info', ['crypto' => 'btc']) }}">
                    @csrf
                    <input type="hidden" name="detail" value="personaldetails">
                    <div class="row">
                      <div class="col-12 ">
                        <div class="form-group">
                          <label for="btc_wallet_address_name">Variable Name <small>(BTC Wallet Address)</small></label>
                          <input type="text" value="{{ config('global.btc_wallet_address')['name'] }}" class="form-control" data-bv-field="btc_wallet_address_name" id="btc_wallet_address_name" required="" placeholder="Variable Name" name="btc_wallet_address_name">
                        </div>
                      </div>
                      <div class="col-12 ">
                        <div class="form-group text-danger">
                          <label for="btc_wallet_address_value">Variable Value <small>(BTC Wallet Address)</small></label>
                          <input type="text" value="{{ config('global.btc_wallet_address')['value'] }}" class="form-control" data-bv-field="btc_wallet_address_value" id="btc_wallet_address_value" required="" placeholder="BTC Wallet Address" name="btc_wallet_address_value">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="btc_wallet_address_decription">Variable Description <small>(For Btc Wallet)</small></label>
                          <textarea name="btc_wallet_address_decription" class="form-control" required="" placeholder="Variable Description">{{ config('global.btc_wallet_address')['description'] }}
                          </textarea>
                        </div>
                      </div>

                      <div class="col-12 alert alert-info">Rate settings</div>

                      <div class="col-12 ">
                        <div class="form-group">
                          <label for="btc_rate_name">Variable Name <small>(BTC Exchange Rate)</small></label>
                          <input type="text" value="{{ config('global.btc_rate')['name'] }}" class="form-control" data-bv-field="btc_rate_name" id="btc_rate_name" required="" placeholder="Variable Name" name="btc_rate_name">
                        </div>
                      </div>
                      <div class="col-12 ">
                        <div class="form-group text-danger">
                          <label for="btc_rate_value">Variable Value <small>(BTC Exchange Rate)</small></label>
                          <input type="text" value="{{ config('global.btc_rate')['value'] }}" class="form-control" data-bv-field="btc_rate_value" id="btc_rate_value" required="" placeholder="BTC Exchange Rate" name="btc_rate_value">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="btc_rate_description">Variable Description <small>(For Exchange Rate)</small></label>
                          <textarea name="btc_rate_description" class="form-control" required="">{{ config('global.btc_rate')['description'] }}
                          </textarea>
                        </div>
                      </div>
                      
                    </div>
                    <button class="btn btn-primary btn-block mt-2" type="submit">Save Changes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>


          <!-- Etheruem
          ============================================= -->
          <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h4 class="text-5 font-weight-400 d-flex align-items-center mb-4">Ethereum Details
              <a href="#edit-eth" data-toggle="modal" class="ml-auto text-2 text-uppercase btn-link"><span class="mr-1"><i class="fas fa-edit"></i></span>Edit</a>
            </h4>
            <hr class="mx-n4 mb-4">
            <div class="row align-items-center my-0 py-0">
              <p class="col-sm-3 text-muted text-sm-right my-0 mb-sm-3">Name:</p>
              <p class="col-sm-9 text-3">{{ config('global.eth_wallet_address')['name'] }}</p>
              <p class="col-sm-3 text-muted text-sm-right my-0 mb-sm-3">Value:</p>
              <p class="col-sm-9 text-5c">{{ config('global.eth_wallet_address')['value'] }}</p>
              <p class="col-sm-3 text-muted text-sm-right my-0 mb-sm-3">Description:</p>
              <p class="col-sm-9 text-3">{{ config('global.eth_wallet_address')['description'] }}</p>
            </div>
            <hr class="mx-n4 mb-4">

            <div class="row align-items-center my-0 py-0">
              <p class="col-sm-3 text-muted text-sm-right my-0 mb-sm-3">Name:</p>
              <p class="col-sm-9 text-3">{{ config('global.eth_rate')['name'] }}</p>
              <p class="col-sm-3 text-muted text-sm-right my-0 mb-sm-3">Value:</p>
              <p class="col-sm-9 text-5c">{{ config('global.eth_rate')['value'] }}</p>
              <p class="col-sm-3 text-muted text-sm-right my-0 mb-sm-3">Description:</p>
              <p class="col-sm-9 text-3">{{ config('global.eth_rate')['description'] }}</p>
            </div>
            
           
            
            <br>
          </div>
          <!-- Edit Details Modal
          ================================== -->


          <div id="edit-eth" class="modal fade " role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title font-weight-400">Edit Ethereum Details</h5>
                  <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body p-4">
                  <form id="personaldetails" method="post" action="{{ route('admin.settings.crypto.set_btc_info', ['crypto' => 'eth']) }}">
                    @csrf
                    <input type="hidden" name="detail" value="personaldetails">
                    <div class="row">
                      <div class="col-12 ">
                        <div class="form-group">
                          <label for="eth_wallet_address_name">Variable Name <small>(Ethereum Wallet Address)</small></label>
                          <input type="text" value="{{ config('global.eth_wallet_address')['name'] }}" class="form-control" data-bv-field="eth_wallet_address_name" id="eth_wallet_address_name" required="" placeholder="Variable Name" name="eth_wallet_address_name">
                        </div>
                      </div>
                      <div class="col-12 ">
                        <div class="form-group text-danger">
                          <label for="eth_wallet_address_value">Variable Value <small>(Ethereum Wallet Address)</small></label>
                          <input type="text" value="{{ config('global.eth_wallet_address')['value'] }}" class="form-control" data-bv-field="eth_wallet_address_value" id="eth_wallet_address_value" required="" placeholder="BTC Wallet Address" name="eth_wallet_address_value">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="eth_wallet_address_decription">Variable Description <small>(For Ethereum Wallet)</small></label>
                          <textarea name="eth_wallet_address_decription" class="form-control" required="" placeholder="Variable Description">{{ config('global.eth_wallet_address')['description'] }}
                          </textarea>
                        </div>
                      </div>

                      <div class="col-12 alert alert-info">Rate settings</div>

                      <div class="col-12 ">
                        <div class="form-group">
                          <label for="eth_rate_name">Variable Name <small>(Ethereum Exchange Rate)</small></label>
                          <input type="text" value="{{ config('global.eth_rate')['name'] }}" class="form-control" data-bv-field="eth_rate_name" id="eth_rate_name" required="" placeholder="Variable Name" name="eth_rate_name">
                        </div>
                      </div>
                      <div class="col-12 ">
                        <div class="form-group text-danger">
                          <label for="eth_rate_value">Variable Value <small>(Ethereum Exchange Rate)</small></label>
                          <input type="text" value="{{ config('global.eth_rate')['value'] }}" class="form-control" data-bv-field="eth_rate_value" id="eth_rate_value" required="" placeholder="BTC Exchange Rate" name="eth_rate_value">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="eth_rate_description">Variable Description <small>(For Eth Exchange Rate)</small></label>
                          <textarea name="eth_rate_description" class="form-control" required="">{{ config('global.eth_rate')['description'] }}
                          </textarea>
                        </div>
                      </div>
                      
                    </div>
                    <button class="btn btn-primary btn-block mt-2" type="submit">Save Changes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          {{-- Ends here --}}
      
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
