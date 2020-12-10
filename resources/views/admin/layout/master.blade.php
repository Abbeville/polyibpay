<!DOCTYPE html>
<html lang="en">

    @include('admin.layout.partials.headers')

    @yield('more_css')

    <body class="bg-gradient-login">
        <div class="container-login">
            {{-- Content here --}}
            @yield('content')
            {{-- Content ends here --}}

            @include('admin.layout.partials.scripts')
            @yield('more_scripts')
        </div>
    </body>
</html>

