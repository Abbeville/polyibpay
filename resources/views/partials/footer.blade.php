<div class="footer">
    <div class="no-gutters">
        <div class="col-auto mx-auto">
            <div class="row no-gutters justify-content-center">
                <div class="col-auto">
                    <a href="{{ route('users.dashboard') }}" class="btn btn-link-default {{ Route::currentRouteName() == 'users.dashboard' ? 'active' : '' }}">
                        <i class="material-icons">home</i>
                    </a>
                </div>
                <div class="col-auto">
                    <a href="{{ route('users.vcard') }}" class="btn btn-link-default {{ Route::currentRouteName() == 'users.vcard' ? 'active' : '' }}">
                        <i class="material-icons">credit_card</i>
                    </a>

                </div>
                <div class="col-auto">
                    <a href="{{ route('users.transactions', 'all') }}" class="btn btn-link-default {{ Route::currentRouteName() == 'users.transactions' ? 'active' : '' }}">
                        <i class="material-icons">assessment</i>
                    </a>
                </div>

                <div class="col-auto">
                    <a href="#." class="btn btn-link-default menu-btn">
                        <i class="material-icons">subject</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
