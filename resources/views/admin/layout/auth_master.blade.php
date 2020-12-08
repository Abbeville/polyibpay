<!DOCTYPE html>
<html lang="en">

    @include('admin.layout.partials.headers')

    @yield('more_css')

    <body id="page-top">
        <div id="wrapper">

            @include('admin.layout.partials.side_pane_nav')

            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    
                    @include('sweetalert::alert')

                    @include('admin.layout.partials.top_nav')

                    <div class="container-fluid" id="container-wrapper">

                        @include('admin.layout.partials.alerts')

                        @yield('content')

                    </div>

                </div>


                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> 
                                {{-- developed by
                                <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b> --}}
                            </span>
                        </div>
                    </div>
                </footer>

            </div>
        </div>

        <!-- Scroll to top -->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        @include('admin.layout.partials.scripts')
        @yield('more_scripts')
        </div>
    </body>
</html>

