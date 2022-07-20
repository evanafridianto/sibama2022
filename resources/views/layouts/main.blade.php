<!DOCTYPE html>
<html lang="en">

@section('head')
    @include('layouts.head')
@show

<body>
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper" class="show">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{ route('dashboard') }}" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('admin/images/logo-white-sibama.png') }}" alt="">
                <img class="logo-compact" src="{{ asset('admin/images/logo-text-white-sibama.png') }}" alt="">
                <img class="brand-title" src="{{ asset('admin/images/logo-text-white-sibama.png') }}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        @section('header')
            @include('layouts.header')
        @show
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @section('sidebar')
            @include('layouts.sidebar')
        @show
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div id="content-body">
            @yield('content')
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        @section('footer')
            @include('layouts.footer')
        @show
        <!--**********************************
            Footer end
        ***********************************-->
    </div>

    <!--**********************************
        Scripts
    ***********************************-->

    @section('script')
        @include('layouts.script')
    @show


</body>

</html>
