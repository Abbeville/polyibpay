@extends('layouts.fullLayoutMaster')



@section('content')
    <section class="row flexbox-container">
        <div class="col-xl-7 col-md-8 col-12 d-flex justify-content-center">
            <div class="card auth-card bg-transparent shadow-none rounded-0 mb-0 w-100">
                <div class="card-content">
                    <div class="card-body text-center">
                        <img src="https://demo.sgeinitiative.org/wp-content/uploads/2020/04/sge-logo-space.png"
                             class="align-self-center" alt="branding logo">
                        <h1 class="font-large-2 my-1 mt-25">Welcome to SGE Initiative Membership Portal</h1>
                        <p class="px-2">
                            paraphonic unassessable foramination Caulopteris worral Spirophyton encrimson esparcet
                            aggerate chondrule
                            restate whistler shallopy biosystematy area bertram plotting unstarting quarterstaff.
                        </p>
                        <a class="btn btn-outline-primary btn-lg mt-1" href="{{ route('register')}} "><i
                                    class="fa fa-user-plus"></i> Create an Account</a>
                        <a class="btn btn-primary btn-lg mt-1" href="{{ route('login')}}"><i class="fa fa-lock"></i>
                            Login</a>
                        <hr/>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a class="btn btn-primary btn-lg border-right  mt-1" href="#."><i class="fa fa-globe"></i>
                                SGE Website</a>
                            <a class="btn btn-primary btn-lg mt-1" href="#."><i class="fa fa-question-circle"></i> Learn
                                More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
