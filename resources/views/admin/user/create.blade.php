@extends('admin.layout.auth_master')

@section('page_title', 'Admin User Management')

@section('more_css')
{{-- More CSS here --}}
   <link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">   

@endsection

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">New User</h1>
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
          <p>You are about to create new user resource</p>
      </div>
      <div class="col-md-9 register-right">
          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
              <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Employee</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Hirer</a>
              </li>
          </ul>
          <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <h3 class="register-heading">Create New User</h3>
                  <div class="row register-form">
                      <div class="col-md-6">
                          <div class="form-group">
                              <input name="firstname" type="text" class="form-control" placeholder="First Name *" value="" required="" />
                          </div>
                          <div class="form-group">
                              <input name="lastname" type="text" class="form-control" placeholder="Last Name *" value="" required="" />
                          </div>
                          <div class="form-group">
                              <input name="email" type="email" class="form-control" placeholder="Your Email *" value="" required="" />
                          </div>
                          <div class="form-group">
                              <input name="phone_number" type="number" minlength="11" maxlength="11" name="txtEmpPhone" class="form-control" placeholder="Your Phone *" value="" />
                          </div>
                          
                          <div class="form-group">
                              <div class="maxl">
                                  <label class="radio inline"> 
                                      <input type="radio" name="status" value="active" checked>
                                      <span> Active User Account </span> 
                                  </label>
                                  <label class="radio inline"> 
                                      <input type="radio" name="status" value="inactive">
                                      <span>Inactive User Account</span> 
                                  </label>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <input name="eth_address" type="text" class="form-control" placeholder="Ethereum Wallet Address" value="" />
                          </div>
                          <div class="form-group">
                              <input name="btc_address" type="text"  name="txtEmpPhone" class="form-control" placeholder=" BTC Wallet Address *" value="" />
                          </div>
                          <div class="form-group">
                              <select class="form-control">
                                  <option class="hidden"  selected disabled>Please select your Bank Name</option>
                                  <option>Bank </option>
                                  <option>What is Your old Phone Number</option>
                                  <option>What is your Pet Name?</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <input name="account_number" type="text" class="form-control" placeholder="Account Number *" value="" />
                          </div>
                          <div class="form-group">
                              <button class="btn btn-info">Verify Bank Account</button>
                          </div>
                          <input type="submit" class="btnRegister"  value="Register"/>
                      </div>
                  </div>
              </div>
              <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <h3  class="register-heading">Apply as a Hirer</h3>
                  <div class="row register-form">
                      <div class="col-md-6">
                          <div class="form-group">
                              <input type="text" class="form-control" placeholder="First Name *" value="" />
                          </div>
                          <div class="form-group">
                              <input type="text" class="form-control" placeholder="Last Name *" value="" />
                          </div>
                          <div class="form-group">
                              <input type="email" class="form-control" placeholder="Email *" value="" />
                          </div>
                          <div class="form-group">
                              <input type="text" maxlength="10" minlength="10" class="form-control" placeholder="Phone *" value="" />
                          </div>


                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <input type="password" class="form-control" placeholder="Password *" value="" />
                          </div>
                          <div class="form-group">
                              <input type="password" class="form-control" placeholder="Confirm Password *" value="" />
                          </div>
                          <div class="form-group">
                              <select class="form-control">
                                  <option class="hidden"  selected disabled>Please select your Sequrity Question</option>
                                  <option>What is your Birthdate?</option>
                                  <option>What is Your old Phone Number</option>
                                  <option>What is your Pet Name?</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <input type="text" class="form-control" placeholder="`Answer *" value="" />
                          </div>
                          <input type="submit" class="btnRegister"  value="Register"/>
                      </div>
                  </div>
              </div>
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

      function delet(id, route) {
         $('.modal_delete').modal({show: true});
         $('#yes_delete').click(function(){
             window.location.href = route;
         })
      }
       
   </script>
@endsection
