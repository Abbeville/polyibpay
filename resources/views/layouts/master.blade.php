<!doctype html>
<html lang="en" class="deeppurple-theme">
<head>

    @include('partials.meta')
    @include('partials.styles')
</head>

<body>

<div class="row no-gutters vh-100 loader-screen">
    <div class="col align-self-center text-white text-center">
        <img src="{{ asset('assets/img/logo.png') }}" alt="logo">
        <h1 class="mt-3"><span class="font-weight-light ">Bills</span>Pay</h1>
        <p class="text-mute text-uppercase small">All transactions in one place</p>
        <div class="laoderhorizontal">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<div class="sidebar">
    <div class="mt-4 mb-3">
        <div class="row">
            <div class="col-auto">
{{--                <figure class="avatar avatar-60 border-0"><img src="https://ui-avatars.com/api/?name={{ auth()->user()->firstname.'+'.auth()->user()->lastname }}" alt=""></figure>--}}
            </div>
            <div class="col pl-0 align-self-center">
{{--                <h5 class="mb-1">{{  auth()->user()->firstname.' '.auth()->user()->lastname }}</h5>--}}
                <p class="text-mute small">Good morning</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="list-group main-menu">
         @include('partials.navs')
            </div>
        </div>
    </div>
</div>
<a href="javascript:void(0)" class="closesidemenu"><i class="material-icons icons-raised bg-dark ">close</i></a>

<!-- Loader -->
<div class="row no-gutters vh-100 loader-screen">
    <div class="col align-self-center text-white text-center">
        <img src="{{ asset('assets/img/logo.png') }}" alt="logo">
        <h1 class="mt-3"><span class="font-weight-light ">Bills</span>Pay</h1>
        <p class="text-mute text-uppercase small">All transactions in one place</p>
        <div class="laoderhorizontal">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<!-- Loader ends -->

@yield('contents')


{{--

<!-- notification -->
<div class="notification bg-white shadow-sm border-primary">
    <div class="row">
        <div class="col-auto align-self-center pr-0">
            <i class="material-icons text-primary md-36">fullscreen</i>
        </div>
        <div class="col">
            <h6>Viewing in Phone?</h6>
            <p class="mb-0 text-secondary">Double tap to enter into fullscreen mode for each page.</p>
        </div>
        <div class="col-auto align-self-center pl-0">
            <button class="btn btn-link closenotification"><i class="material-icons text-secondary text-mute md-18 ">close</i>
            </button>
        </div>
    </div>
</div>
<!-- notification ends -->


--}}




<!-- color chooser menu start -->
<div class="modal fade " id="colorscheme" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-header theme-header border-0">
                <h6 class="">Color Picker</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="text-center theme-color">
                    <button class="m-1 btn red-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="red-theme"><i
                                class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn blue-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="blue-theme"><i
                                class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn yellow-theme-bg text-white btn-rounded-54 shadow-sm"
                            data-theme="yellow-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn green-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="green-theme">
                        <i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn pink-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="pink-theme"><i
                                class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn orange-theme-bg text-white btn-rounded-54 shadow-sm"
                            data-theme="orange-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn purple-theme-bg text-white btn-rounded-54 shadow-sm"
                            data-theme="purple-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn deeppurple-theme-bg text-white btn-rounded-54 shadow-sm"
                            data-theme="deeppurple-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn lightblue-theme-bg text-white btn-rounded-54 shadow-sm"
                            data-theme="lightblue-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn teal-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="teal-theme"><i
                                class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn lime-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="lime-theme"><i
                                class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn deeporange-theme-bg text-white btn-rounded-54 shadow-sm"
                            data-theme="deeporange-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn gray-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="gray-theme"><i
                                class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn black-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="black-theme">
                        <i class="material-icons w-50">color_lens_outline</i></button>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-6 text-left">
                    <div class="row">
                        <div class="col-auto text-right align-self-center"><i class="material-icons text-warning vm">wb_sunny</i>
                        </div>
                        <div class="col-auto text-center align-self-center px-0">
                            <div class="custom-control custom-switch float-right">
                                <input type="checkbox" name="themelayout" class="custom-control-input" id="theme-dark">
                                <label class="custom-control-label" for="theme-dark"></label>
                            </div>
                        </div>
                        <div class="col-auto text-left align-self-center"><i class="material-icons text-dark vm">brightness_2</i>
                        </div>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <div class="row">
                        <div class="col-auto text-right align-self-center">LTR</div>
                        <div class="col-auto text-center align-self-center px-0">
                            <div class="custom-control custom-switch float-right">
                                <input type="checkbox" name="rtllayout" class="custom-control-input" id="theme-rtl">
                                <label class="custom-control-label" for="theme-rtl"></label>
                            </div>
                        </div>
                        <div class="col-auto text-left align-self-center">RTL</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- color chooser menu ends -->

<!-- Modal -->
<div class="modal fade" id="addmoney" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <img src="img/infomarmation-graphics2.png" alt="logo" class="logo-small">
                <div class="form-group mt-4">
                    <input type="text" class="form-control form-control-lg text-center" placeholder="Enter amount"
                           required="" autofocus="">
                </div>
                <p class="text-mute">You will be redirected to payment gatway to procceed further. Enter amount in
                    USD.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-default btn-lg btn-rounded shadow btn-block" class="close"
                        data-dismiss="modal">Next
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="sendmoney" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5>Send Money</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="form-group mt-4">
                    <select class="form-control form-control-lg text-center">
                        <option>Mrs. Magon Johnson</option>
                        <option selected>Ms. Shivani Dilux</option>
                    </select>
                </div>

                <div class="card shadow border-0 mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto pr-0">
                                <div class="avatar avatar-60 no-shadow border-0">
                                    <img src="img/user2.png" alt="">
                                </div>
                            </div>
                            <div class="col">
                                <h6 class="font-weight-normal mb-1">Ms. Shivani Dilux</h6>
                                <p class="text-mute small text-secondary">London, UK</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center mt-4">
                    <input type="text" class="form-control form-control-lg text-center" placeholder="Enter amount"
                           required="" autofocus="">
                </div>
                <p class="text-mute text-center">You will be redirected to payment gatway to procceed further. Enter
                    amount in USD.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-default btn-lg btn-rounded shadow btn-block" class="close"
                        data-dismiss="modal">Next
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="paymodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5>Pay</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">To Bill</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input"
                           checked>
                    <label class="custom-control-label" for="customRadioInline2">To Person</label>
                </div>

                <div class="form-group mt-4">
                    <select class="form-control text-center">
                        <option>Mrs. Magon Johnson</option>
                        <option selected>Ms. Shivani Dilux</option>
                    </select>
                </div>

                <div class="card shadow border-0 mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto pr-0">
                                <div class="avatar avatar-60 no-shadow border-0">
                                    <img src="img/user2.png" alt="">
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <h6 class="font-weight-normal mb-1">Ms. Shivani Dilux</h6>
                                <p class="text-mute small text-secondary">London, UK</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center mt-4">
                    <input type="text" class="form-control form-control-lg text-center" placeholder="Enter amount"
                           required="" autofocus="">
                </div>
                <p class="text-mute text-center">You will be redirected to payment gatway to procceed further. Enter
                    amount in USD.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-default btn-lg btn-rounded shadow btn-block" class="close"
                        data-dismiss="modal">Next
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="bookmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5>Pay</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline12" name="customRadioInline12"
                           class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline12">Flight</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline22" name="customRadioInline12" class="custom-control-input"
                           checked>
                    <label class="custom-control-label" for="customRadioInline22">Train</label>
                </div>
                <h6 class="subtitle">Select Location</h6>
                <div class="form-group mt-4">
                    <input type="text" class="form-control text-center" placeholder="Select start point" required=""
                           autofocus="">
                </div>
                <div class="form-group mt-4">
                    <input type="text" class="form-control text-center" placeholder="Select end point" required="">
                </div>
                <h6 class="subtitle">Select Date</h6>
                <div class="form-group mt-4">
                    <input type="date" class="form-control text-center" placeholder="Select end point" required="">
                </div>
                <h6 class="subtitle">number of passangers</h6>
                <div class="form-group mt-4">
                    <select class="form-control  text-center">
                        <option>1</option>
                        <option selected>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-default btn-lg btn-rounded shadow btn-block" class="close"
                        data-dismiss="modal">Next
                </button>
            </div>
        </div>
    </div>
</div>


@include('partials.scripts')


</body>
</html>
