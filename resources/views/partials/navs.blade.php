<a href="{{ route('users.dashboard') }}" class="list-group-item list-group-item-action active"><i
            class="material-icons icons-raised">home</i>Home</a>



<a href="#" class="list-group-item list-group-item-action"><i
            class="material-icons icons-raised">person</i>My Profile</a>

<a href="{{ route('users.settings.index') }}" class="list-group-item list-group-item-action"><i
            class="material-icons icons-raised">settings</i>Settings</a>


<a href="javascript:void(0)" class="list-group-item list-group-item-action" data-toggle="modal"
   data-target="#colorscheme"><i class="material-icons icons-raised">person_add</i>Invite your friends</a>



<a href="{{ route('logout') }}" class="list-group-item list-group-item-action" onclick="event.preventDefault();  document.getElementById('logout-form').submit();"><i
            class="material-icons icons-raised bg-danger">power_settings_new</i>Logout</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>


