<!DOCTYPE html>
<html lang="ar" dir="rtl">

    <head>
        <meta charset="UTF-8">

        <title>تسجيل الدخول - المركز السعودي</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href={{ asset("assets/libs/jqvmap/jqvmap.min.css")}} rel="stylesheet" />
        <link href="{{asset('assets/css/bootstrap-rtl.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/app-rtl.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

        <link href={{ asset("assets/css/custom-style.css")}} id="custom-style" rel="stylesheet" type="text/css" />

        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

        <!-- Icons Css -->
        <!-- App Css-->

    </head>

    <body class="bg-pattern" style="background: none !important;background: rgb(237,144,240) !important;
    background: linear-gradient(90deg, rgba(237,144,240,1) 0%, rgba(9,92,121,1) 33%, rgba(0,212,255,1) 100%) !important;">
        <div class="bg-overlay"></div>
        <div class="account-pages my-5 pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-6 col-md-8">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="">
                                    <div class="text-center">

                                    </div>
                                    <!-- end row -->
                                    <h4 class="font-size-18 text-muted mt-2 text-center">مرحباً بك</h4>
                                    <p class="mb-5 text-center">صفحة تسجيل دخول- المركز السعودي</p>
                                    <form class="form-horizontal" method="POST" action="{{route('login.post')}}">
                                        @csrf
                                        @include('includes.message')
                                        <div class="row" style="margin-top: 10px">
                                            <div class="col-md-12">
                                                <div class="mb-4">
                                                    <label class="form-label" for="username">البريد الإلكتروني</label>
                                                    <input type="email" class="form-control" name="email" value="{{old('email')}}" id="email" placeholder="البريد الإلكتروني">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="password">كلمة السر</label>
                                                    <input type="password" name="password" class="form-control" id="password" placeholder="كلمة السر">
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        {{-- <div class="form-check"> --}}
                                                           <div style="    margin-right: 10px; margin-top: 2px;">

                                                            <input type="checkbox" class="form-check-input" id="customControlInline">
                                                            <label class="form-label" class="form-check-label" for="customControlInline">تذكرني</label>

                                                           </div>

                                                        {{-- </div> --}}
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="text-md-end mt-3 mt-md-0">
                                                            <a href="{{route('forget.password.get')}}" class="text-muted"> <i class="mdi mdi-lock"></i>  هل نسيت كلمة السر؟  </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-grid mt-4">
                                                    <button class="btn btn-primary waves-effect waves-light" type="submit">دخول</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            {{-- <p class="text-white-50">Don't have an account ? <a href="auth-register.html" class="fw-medium text-primary"> Register </a> </p> --}}
                            <p class="text-white-50">© <script>document.write(new Date().getFullYear())</script> المركز السعودي  </p>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end Account pages -->

        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>

    </body>
</html>
