@extends('admin.layout.auth_master')

@section('page_title', 'Admin User Management')

@section('more_css')
{{-- More CSS here --}}
   <link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">


@endsection

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">User Management</h1>
   <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">All Users</li>
   </ol>
</div>


<div class="row mb-3">
   <!-- Earnings (Monthly) Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
         <div class="row align-items-center">
          <div class="col mr-2">
           <div class="text-xs font-weight-bold text-uppercase mb-1">All Registered Users</div>
           <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($all_users) }}</div>
           <div class="mt-2 mb-0 text-muted text-xs">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
            <span>Since last month</span>
         </div>
      </div>
      <div class="col-auto">
        <i class="fas fa-users fa-2x text-primary"></i>
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
        <div class="text-xs font-weight-bold text-uppercase mb-1">Active Users</div>
        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($active_users) }}</div>
        <div class="mt-2 mb-0 text-muted text-xs">
         <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> {{ number_format((count($active_users)/(count($all_users) > 0 ? count($all_users) :  1)) * 100, 2) }}%</span>
         <span>Users that still perform</span>
      </div>
   </div>
   <div class="col-auto">
     <i class="fas fa-users fa-2x text-success"></i>
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
        <div class="text-xs font-weight-bold text-uppercase mb-1">New Users</div>
        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ count($new_users) }}</div>
        <div class="mt-2 mb-0 text-muted text-xs">
         <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> {{ number_format((count($new_users)/(count($all_users) > 0 ? count($all_users) :  1)) * 100, 2) }}%</span>
         <span>Since Beginning of this {{ \Carbon\Carbon::now()->format('F') }}</span>
      </div>
   </div>
   <div class="col-auto">
     <i class="fas fa-users fa-2x text-info"></i>
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
        <div class="text-xs font-weight-bold text-uppercase mb-1">Suspended Users</div>
        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($suspended_users) }}</div>
        <div class="mt-2 mb-0 text-muted text-xs">
         <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> {{ number_format((count($suspended_users)/(count($all_users) > 0 ? count($all_users) :  1)) * 100, 2) }}%</span>
         <span>Since yesterday</span>
      </div>
   </div>
   <div class="col-auto">
     <i class="fas fa-users fa-2x text-danger"></i>
  </div>
</div>
</div>
</div>
</div>

<div class="col-md-6">
   <div class="alert alert-info " role="alert">
     <h6><i class="fas fa-users"></i> Category in View:<b class="text-danger"> {{ $users['cat'] }} Users</b></h6>
     The category of Users currently in View
   </div>
</div>
<div class="col-md-6">
   <form method="GET" action="{{ route('admin.user.listing') }}" id="user_listing">
      <div class="form-group">
         <label class="control-label col-md-5 col-sm-5 col-xs-12">Select Category:</label>
         <div class="col-md-12 col-sm-12 col-xs-12">
            <select name="type" class="form-control" id="user_type" onchange="event.preventDefault();  document.getElementById('user_listing').submit();">
               <option value="" selected="" disabled="">select category</option>
               <option value="all">All Users</option>
               <option value="active">Active Users</option>
               <option value="inactive">Inactive Users</option>
               <option value="suspended">Suspended Users</option>
            </select>
         </div>
      </div>
   </form>
</div>

<!-- DataTable with Hover -->
<div class="col-lg-12">
   <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
         <h6 class="m-0 font-weight-bold text-primary">All Users Listing</h6>
      </div>
      <div class="table-responsive p-3" style="font-size: 13px;">
         <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
               <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Phone Number</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Joined At</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tfoot>
               <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Phone Number</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Joined At</th>
                  <th>Actions</th>
               </tr>
            </tfoot>
            <tbody>
               @forelse($users['users'] as $user)
                  <tr>
                     <td>{{ $loop->iteration }}</td>
                     <td>{{ $user->user_id }}</td>
                     <td>{{ $user->fullname }}</td>
                     <td>{{ $user->phone_number }}</td>
                     <td>{{ $user->email }}</td>
                     <td>
                        @if($user->status == 'active')
                            <span class="badge badge-success">{{ __('Active') }}</span>
                        @elseif($user->status == 'inactive')
                            <span class="badge badge-warning"> {{ __('Inactive') }}</span>
                        @elseif($user->status == 'suspended')
                            <span class="badge badge-danger"> {{ __('Suspended') }}</span>
                        @endif
                     </td>
                     <td>{{ $user->created_at->diffForHumans() }}</td>
                     <td>
                        <a href="{{ route('admin.user.show', ['user' => $user->id]) }}" class="btn btn-sm btn-success" title='View'>
                           <i class="fa fa-eye"></i>
                        </a>

                        {{-- <a href="#" class="btn btn-sm btn-danger" title='Delete' rel="" onclick="delet({{ $user->id }}, '')">
                           <i class="fa fa-trash"></i>
                        </a> --}}
                     </td>
                  </tr>
               @empty


               @endforelse
            </tbody>
         </table>
      </div>
   </div>
</div>


      {{-- Delete Modal  --}}
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
