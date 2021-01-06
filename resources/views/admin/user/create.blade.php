@extends('admin.layout.auth_master')

@section('page_title', 'Admin User Management')

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
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">New User</a>
              </li>

          </ul>
          <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <h3 class="register-heading">Create New User</h3>
                  <div class=" register-form pt-5">
                    <form method="POST" action="{{ route('admin.user.store') }}">
                      @csrf
                      <div class="col-md-12">
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

                          <p class="text-danger"><b>Note:</b> User default password for the account created is "password".</p>
                          <input type="submit" class="btnRegister mb-3"  value="Create"/>
                      </div>
                    </form>
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
