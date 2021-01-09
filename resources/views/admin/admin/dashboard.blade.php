@extends('admin.layout.auth_master')

@section('page_title', 'Admin Dashboard')

@section('more_css')
{{-- More CSS here --}}

@endsection

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
   <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
   </ol>
</div>


<div class="row mb-3">
   <!-- Earnings (Monthly) Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
         <div class="row align-items-center">
          <div class="col mr-2">
           <div class="text-xs font-weight-bold text-uppercase mb-3">Bill Transactions (This Month)</div>
           <div class="h5 mb-0 font-weight-bold text-gray-800">#{{ number_format($bill_transactions_l ?? 0) }}</div>
           <div class="mt-2 mb-0 text-muted text-xs">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
            <span>Since last month</span>
         </div>
      </div>
      <div class="col-auto">
        <a href="{{ url('admin/transaction/index?type=bill') }}">
          <i class="float-right fa fa-arrow-right"></i>
        </a>
        <br>
        <br>
        <i class="fas fa-calendar fa-2x text-primary"></i>
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
        <div class="text-xs font-weight-bold text-uppercase mb-3">Wallet Top-Ups (This Month)</div>
        <div class="h5 mb-0 font-weight-bold text-gray-800"># {{ number_format($top_up_transactions_l ?? 0)  }}</div>
        <div class="mt-2 mb-0 text-muted text-xs">
         <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
         <span>Since last years</span>
      </div>
   </div>
   <div class="col-auto">
        <a href="{{ url('admin/transaction/index?type=top_up') }}">
          <i class="float-right fa fa-arrow-right"></i>
        </a>
        <br>
        <br>
        <i class="fas fa-shopping-cart fa-2x text-success"></i>
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
        <div class="text-xs font-weight-bold text-uppercase mb-3">All Users</div>
        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $users->count() }}</div>
        <div class="mt-2 mb-0 text-muted text-xs">
         <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
         <span>Since last month</span>
      </div>
   </div>
   <div class="col-auto">
        <a href="{{ route('admin.user.index') }}">
          <i class="float-right fa fa-arrow-right"></i>
        </a>
        <br>
        <br>
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
        <div class="text-xs font-weight-bold text-uppercase mb-3">Pending Requests</div>
        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pending_transactions->count() }}</div>
        <div class="mt-2 mb-0 text-muted text-xs">
         <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
         <span>Since yesterday</span>
      </div>
   </div>
   <div class="col-auto">
        <a href="{{ url('admin/transaction/index?type=pending') }}">
          <i class="float-right fa fa-arrow-right"></i>
        </a>
        <br>
        <br>
     <i class="fas fa-comments fa-2x text-warning"></i>
  </div>
</div>
</div>
</div>
</div>

<!-- Area Chart -->
<div class="col-xl-8 col-lg-7">
   <div class="card mb-4">
     <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Monthly Recap Report</h6>
      <div class="dropdown no-arrow">
       <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">
       <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
    aria-labelledby="dropdownMenuLink">
    <div class="dropdown-header">Dropdown Header:</div>
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">Something else here</a>
 </div>
</div>
</div>
<div class="card-body">
   {{-- <div class="chart-area">
    <canvas id="myAreaChart"></canvas>
 </div> --}}

 <div class="row">
   <div class="col-md-6">
     <div class="card">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Monthly 5 Top Savers</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush" style="font-size: 12px">
               <thead class="thead-light">
                <tr>
                 <th>User</th>
                 <th>Amount Deposited</th>
                </tr>
               </thead>
               <tbody>
                @forelse($top_savers as $top)
                  <tr>
                    <td><a href="{{ route('admin.user.show', $top->user_id) }}">{{ $top->user->fullname }}</a></td>
                    <td>{{ number_format($top->total_amount) }}</td>
                  </tr>
                @empty
                  <tr>
                    <td class="text-center" colspan="2">No data</td>
                  </tr>
                @endforelse
               </tbody>
             </table>
          </div>
        </div>
     </div>
   </div>
   <div class="col-md-6">
     <div class="card">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-danger">Monthly 5 Top Spenders</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush" style="font-size: 12px">
               <thead class="thead-light">
                <tr>
                 <th>User</th>
                 <th>Amount Spent</th>
                </tr>
               </thead>
               <tbody>
                @forelse($top_debits as $top)
                  <tr>
                    <td><a href="{{ route('admin.user.show', $top->user_id) }}">{{ $top->user->fullname }}</a></td>
                    <td>{{ number_format($top->total_amount) }}</td>
                  </tr>
                @empty
                  <tr>
                    <td class="text-center" colspan="2">No data</td>
                  </tr>
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
<!-- Pie Chart -->
<div class="col-xl-4 col-lg-5">
   <div class="card mb-4">
     <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
      <div class="dropdown no-arrow">
       <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id="dropdownMenuLink"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       Month <i class="fas fa-chevron-down"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
    aria-labelledby="dropdownMenuLink">
    
    <div class="dropdown-header">Select Period</div>
    <a class="dropdown-item" href="{{ route('admin.dashboard', 'today') }}">Today</a>
    <a class="dropdown-item" href="{{ route('admin.dashboard', 'week') }}">Week</a>
    <a class="dropdown-item active" href="{{ route('admin.dashboard', 'month') }}">Month</a>
    <a class="dropdown-item" href="{{ route('admin.dashboard', '3month') }}">3 months</a>
 </div>
</div>
</div>
<div class="card-body">

  @forelse($trans as $tran)
    <div class="mb-3">
      <div class="small text-gray-500">{{ $tran->category }}
         <div class="small float-right"><b>{{ $tran->cat_count }} of {{ $transactions->count() }} Trans</b></div>
      </div>
      <div class="progress" style="height: 12px;">
         <div class="progress-bar 

         @if($tran->category == 'wallet')
          bg-warning
         @elseif($tran->category == 'crypto')
          bg-info
         @elseif($tran->category == 'bill')
          bg-danger
         @elseif($tran->category == 'airtime')
          bg-success
         @elseif($tran->category == 'data_bundle')
          bg-primary
         @endif
         " role="progressbar" style="width: {{ number_format(($tran->cat_count/(count($transactions) > 0 ? count($transactions) :  1)) * 100, 2) }}%" aria-valuenow="80"
         aria-valuemin="0" aria-valuemax="100"></div>
      </div>
    </div>

  @empty

    <p class="text-danger"><em>No info to display</em></p>
  @endforelse

</div>

</div>
</div>
<!-- Invoice Example -->
<div class="col-xl-8 col-lg-7 mb-4">
   <div class="card">
     <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Crypto Requests</h6>
      <a class="m-0 float-right btn btn-danger btn-sm" href="{{ url('admin/transaction/index?type=crypto') }}">View More <i
        class="fas fa-chevron-right"></i></a>
     </div>
     <div class="table-responsive">
      <table class="table align-items-center table-flush">
       <thead class="thead-light">
        <tr>
         <th>Order ID</th>
         <th>Amount</th>
         <th>Status</th>
         <th>Time</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody>

    @forelse($pending_cryp as $crypto)
     <tr>
      <td class="text-info">{{ $crypto->custom_ref ?? 'empty' }}</td>
      <td>{{ $crypto->amount }}</td>
      <td><span class="badge badge-warning">{{ $crypto->status }}</span></td>
      <td><span class="">{{ $crypto->created_at->diffForHumans() }}</span></td>
      <td><a href="{{ route('admin.transaction.show', $crypto->id) }}" class="btn btn-sm btn-primary">Detail</a></td>
     </tr>


   @empty
    <tr>
      <td colspan="5" class="text-center"> No pending crypto request</td>
     </tr>


   @endforelse
   
</tbody>
</table>
</div>
<div class="card-footer"></div>
</div>
</div>
<!-- Message From Customer-->
<div class="col-xl-4 col-lg-5 ">
   <div class="card">
     <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-light">All Time Analysis</h6>
   </div>
   <div>

    <div class="table-responsive">
      <table class="table align-items-center table-flush" style="font-size: 12px">
         <thead class="thead-light">
          <tr>
           <th>Info</th>
           <th>Amount/Counts </th>
          </tr>
         </thead>
         <tbody>

            <tr>
              <td>All time Spendings</td>
              <td># {{ number_format($bill_transactions ?? 0) }}</td>
            </tr>
            <tr>
              <td>All time Cryto Transactions</td>
              <td>{{ $crypto_transactions ?? 0 }}</td>
            </tr>
            <tr>
              <td>All time Registered Users</td>
              <td>{{ $users->count() ?? 0 }}</td>
            </tr>
            <tr>
              <td>All time Transactions</td>
              <td>{{ $transactions->count() ?? 0 }}</td>
            </tr>

         </tbody>
       </table>
    </div>

</div>
</div>
</div>
</div>
<!--Row-->



   <!-- Modal Logout -->
   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
       </button>
    </div>
    <div class="modal-body">
      <p>Are you sure you want to logout?</p>
   </div>
   <div class="modal-footer">
      <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
      <a href="login.html" class="btn btn-primary">Logout</a>
   </div>
</div>
</div>
</div>

@endsection


@section('more_scripts')
   {{-- More Scripts --}}
   <script src="{{ asset('admin_assets/vendor/chart.js/Chart.min.js') }}"></script>
   <script src="{{ asset('admin_assets/js/demo/chart-area-demo.js') }}"></script> 
@endsection
