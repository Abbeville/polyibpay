@extends('layouts.master')

@section('contents')

    <!-- navbar end -->
    <div class="ba-navbar">
        <div class="ba-navbar-user">
            <div class="menu-close">
                <i class="la la-times"></i>
            </div>
            <div class="thumb">
                <img src="assets/img/user.png" alt="user">
            </div>
            <div class="details">
                <h5>Raduronto kelax</h5>
                <p>ID: 99883323</p>
            </div>
        </div>
        <div class="ba-add-balance-title">
            <h5>Add Balance</h5>
            <p>$458786.00</p>
        </div>
        <div class="ba-add-balance-title style-two">
            <h5>Deposit</h5>
            <i class="fa fa-plus"></i>
        </div>
        <div class="ba-main-menu">
            <h5>Menu</h5>
            <ul>
                <li><a href="home.html">Bankapp Display</a></li>
                <li><a href="all-page.html">Pages</a></li>
                <li><a href="component.html">Components</a></li>
                <li><a href="carts.html">My Cart</a></li>
                <li><a href="user-setting.html">Setting</a></li>
                <li><a href="notiFication-2.html">Notification</a></li>
                <li><a href="signup.html">Logout</a></li>
            </ul>
            <a class="btn btn-purple" href="#">View Profile</a>
        </div>
    </div>
    <!-- navbar end -->

    <!-- navbar end -->
    <div class="add-balance-inner-wrap">
        <div class="container">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Balance</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <form action="http://www.s7template.com/tf/bankapp/index.html">
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="account1">From</label>
                                        <select class="form-control custom-select" id="account1">
                                            <option value="0">Investment (*** 7284)</option>
                                            <option value="1">Savings (*** 5078)</option>
                                            <option value="2">Deposit (*** 2349)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <label class="label">Enter Amount</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="input1">$</span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg" value="768">
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <button type="button" class="btn-c btn-primary btn-block btn-lg"
                                            data-dismiss="modal">Deposit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- navbar end -->

    <!-- balance start -->
    <div class="balance-area pd-top-40 mg-top-50">
        <div class="container">
            <div class="balance-area-bg balance-area-bg-home">
                <div class="balance-title text-center">
                    <h6>Welcome! <br> Dear Mr Suvro - Bankapp Wallet</h6>
                </div>
                <div class="ba-balance-inner text-center" style="background-image: url(assets/img/bg/2.png);">
                    <div class="icon">
                        <img src="assets/img/icon/1.png" alt="img">
                    </div>
                    <h5 class="title">Total Balance</h5>
                    <h5 class="amount">$56,985.00</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- balance End -->

    <!-- add balance start -->
    <div class="add-balance-area pd-top-40">
        <div class="container">
            <div class="ba-add-balance-title ba-add-balance-btn">
                <h5>Add Balance</h5>
                <i class="fa fa-plus"></i>
            </div>
            <div class="ba-add-balance-inner mg-top-40">
                <div class="row custom-gutters-20">
                    <div class="col-6">
                        <a class="btn btn-blue ba-add-balance-btn" href="#">Withdraw <i
                                    class="fa fa-arrow-down"></i></a>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-red ba-add-balance-btn" href="#">Send <i class="fa fa-arrow-right"></i></a>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-purple ba-add-balance-btn" href="#">Cards <i
                                    class="fa fa-credit-card-alt "></i></a>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-green ba-add-balance-btn" href="#">Exchange <i
                                    class="fa fa-arrow-down"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add balance End -->



    <!-- transaction start -->
    <div class="transaction-area pd-top-40">
        <div class="container">
            <div class="section-title">
                <h3 class="title">Transactions</h3>
                <a href="#">View All</a>
            </div>
            <ul class="transaction-inner">
                <li class="ba-single-transaction">
                    <div class="thumb">
                        <img src="assets/img/icon/2.png" alt="img">
                    </div>
                    <div class="details">
                        <h5>Namecheap Inc.</h5>
                        <p>Domain Purchase</p>
                        <h5 class="amount">-$130</h5>
                    </div>
                </li>
                <li class="ba-single-transaction">
                    <div class="thumb">
                        <img src="assets/img/icon/3.png" alt="img">
                    </div>
                    <div class="details">
                        <h5>Namecheap Inc.</h5>
                        <p>Domain Purchase</p>
                        <h5 class="amount">-$130</h5>
                    </div>
                </li>
                <li class="ba-single-transaction">
                    <div class="thumb">
                        <img src="assets/img/icon/4.png" alt="img">
                    </div>
                    <div class="details">
                        <h5>Namecheap Inc.</h5>
                        <p>Domain Purchase</p>
                        <h5 class="amount">-$130</h5>
                    </div>
                </li>
                <li class="ba-single-transaction">
                    <div class="thumb">
                        <img src="assets/img/icon/5.png" alt="img">
                    </div>
                    <div class="details">
                        <h5>Namecheap Inc.</h5>
                        <p>Domain Purchase</p>
                        <h5 class="amount">-$130</h5>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- transaction End -->


    <!-- bill-pay start -->
    <div class="bill-pay-area pd-top-36">
        <div class="container">
            <div class="section-title style-three text-center">
                <h3 class="title">Pay Your Monthly Bill</h3>
            </div>
            <div class="ba-bill-pay-inner">
                <div class="ba-single-bill-pay">
                    <div class="thumb">
                        <img src="assets/img/icon/6.png" alt="img">
                    </div>
                    <div class="details">
                        <h5>Envato.com</h5>
                        <p>Standard Elements Services Subscribtion</p>
                    </div>
                </div>
                <div class="amount-inner">
                    <h5>$169</h5>
                    <a class="btn btn-blue" href="#">Pay Now</a>
                </div>
            </div>
            <div class="ba-bill-pay-inner">
                <div class="ba-single-bill-pay">
                    <div class="thumb">
                        <img src="assets/img/icon/3.png" alt="img">
                    </div>
                    <div class="details">
                        <h5>Apple.com</h5>
                        <p>Apple Laptop Monthly Pay System.</p>
                    </div>
                </div>
                <div class="amount-inner">
                    <h5>$130</h5>
                    <a class="btn btn-blue" href="#">Pay Now</a>
                </div>
            </div>
            <div class="ba-bill-pay-inner">
                <div class="ba-single-bill-pay">
                    <div class="thumb">
                        <img src="assets/img/icon/4.png" alt="img">
                    </div>
                    <div class="details">
                        <h5>Amazon.com</h5>
                        <p>Standard Domain Services Subscribtion</p>
                    </div>
                </div>
                <div class="amount-inner">
                    <h5>$130</h5>
                    <a class="btn btn-blue" href="#">Pay Now</a>
                </div>
            </div>
            <div class="btn-wrap text-center mt-4">
                <a class="readmore-btn" href="#">View All</a>
            </div>
        </div>
    </div>
    <!-- bill-pay End -->


@endsection
