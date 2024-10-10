<!doctype html>
<html lang="en" dir="rtl" >
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>المركز السعودي للثقافة و التراث | Saudi Center for Culture and Heritage</title>
    <!-- CSS files -->
    <link href="{{ asset('frontend/dist/css/tabler.rtl.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('frontend/dist/css/tabler-flags.rtl.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('frontend/dist/css/tabler-payments.rtl.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('frontend/dist/css/tabler-vendors.rtl.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('frontend/dist/css/demo.rtl.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="http://www.fontstatic.com/f=jazeera,jazeera-light" rel="stylesheet">

    <style>

      @import url('http://www.fontstatic.com/f=jazeera,jazeera-light');
      :root {
      	font-family: 'jazeera-light';
      }
      body * {
        font-family: 'jazeera-light';
      }
    </style>
     @livewireStyles
  </head>
  <body >
    <script src="./dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page">
      <!-- Navbar -->
      <header class="navbar navbar-expand-md d-print-none" >
        <div class="container-xl">

          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
              <img src="{{ asset('/frontend/assets/logo.svg') }}" width="110" height="32" alt="المركز السعودي للثقافة و التراث" class="navbar-brand-image">
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
              <div class="btn-list">


              </div>
            </div>
            <div class="d-none d-md-flex">


            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url({{ asset('/frontend/assets/logo.svg') }})"></span>
                <div class="d-none d-xl-block ps-2">
                  <div>{{ Auth::guard('actor')->user()->name }}    </div>
                  <div class="mt-1 small text-secondary">{{ Auth::guard('actor')->user()->id_num }}</div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="" class="dropdown-item">تغير كلمة المرور</a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('actor.logout-actor') }}" method="get">
                    @csrf
                    <button class="dropdown-item" type="submit">تسجيل الخروج</button>
                </form>

              </div>
            </div>
          </div>
        </div>
      </header>

      <div class="page-wrapper">
        <!-- Page header -->

        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">

              {{-- <div class="col-12">
                <div class="card card-md">
                  <div class="card-stamp card-stamp-lg">

                  </div>
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-10">
                        <h3 class="h1"></h3>
                        <div class="markdown text-secondary">

                        </div>


                      </div>
                    </div>
                  </div>
                </div>
              </div> --}}
              <livewire:beneficials-actor />
            </div>
          </div>
        </div>
        <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">

                </ul>
              </div>
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    <a href="https//ksach.org" class="link-secondary"> Saudi Center for Culture and Heritage</a>
                  </li>
                  <li class="list-inline-item">
                    <a href="https//ksach.org" class="link-secondary" rel="noopener">
                      v1.0.0
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>

    <!-- Tabler Core -->
    <script src="{{ asset('frontend/dist/js/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('frontend/dist/js/demo.min.js?1692870487') }}" defer></script>
    @livewireScripts
  </body>
</html>
