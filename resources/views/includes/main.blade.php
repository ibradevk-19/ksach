<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>المركز السعودي</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8" />
    <title>Dashboard | Upzet - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">
    @yield('start-style')
    <!-- jvectormap -->
    <link href="{{ asset('assets/libs/jqvmap/jqvmap.min.css')}}" rel="stylesheet" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap-rtl.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app-rtl.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom-style.css') }}" id="custom-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    @livewireStyles
    @yield('style')
</head>

<body data-sidebar="dark">
    <div id="layout-wrapper">

        @include('includes.header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('includes.sidebar')

        <!-- Start right Content here -->
        <div class="main-content">
            <div class="page-content">

                @include('includes.message')
               
                @yield('content')
            </div>
        </div>

        @include('includes.footer')


    </div>

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    @yield('scripts.header')
    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}" ></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>

    <script src="{{asset('assets/libs/axios/dist/axios.min.js')}}"></script>

    <!-- apexcharts js -->
{{--    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>--}}

    <!-- jquery.vectormap map -->
{{--    <script src="{{ asset('assets/libs/jqvmap/jquery.vmap.min.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/libs/jqvmap/maps/jquery.vmap.usa.js') }}"></script>--}}

{{--    <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>--}}
    @livewireScripts
    @yield('scripts.center')

    <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>


    <script src="{{ asset('assets/js/app.js') }}"></script>
    @yield('scripts.footer')
    <script>
        $('.disabled_button_click').click(function () {

            var e = this;
            setTimeout(function () {
                e.disabled = true;
            }, 0);
            return true;

      });
    </script>
    <script>
     $(document).ready(function() {
            $('#family_id').select2();
            $('#actor_id').select2();
            $('#unit_id').select2();
            $('#provider_id').select2();
            $('#product_id').select2();
            $('#beneficiaries_id').select2();
        });
    </script>
      

</body>

</html>
