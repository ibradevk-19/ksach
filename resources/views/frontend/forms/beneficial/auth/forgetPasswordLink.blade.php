<!doctype html>
<html lang="ar" dir="rtl">

    <head>

        <meta charset="utf-8" />
        <title>إعادة تعيين كلمة المرور</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

        <link href="/assets/css/bootstrap-rtl.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <!-- App Css-->
       <link href="/assets/css/app-rtl.min.css" id="app-style" rel="stylesheet" type="text/css" />


    </head>

    <body class="bg-pattern">
        <div class="bg-overlay"></div>
        <div class="account-pages my-5 pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-6 col-md-8">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    {{-- <a href="index.html" class="">
                                        <img src="/assets/images/logo-dark.png" alt="" height="24" class="auth-logo logo-dark mx-auto">
                                        <img src="/assets/images/logo-light.png" alt="" height="24" class="auth-logo logo-light mx-auto">
                                    </a> --}}
                                </div>

                                <h4 class="font-size-18 text-muted text-center mt-2">إعادة تعيين كلمة السر - المركز السعودي</h4>
                                {{-- <p class="text-muted text-center mb-4">Get your free Upzet account now.</p> --}}
                                <form class="form-horizontal" method="POST" action="{{route('reset.password.post')}}">
                                    @include('includes.message')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label class="form-label" for="username">البريد الإلكتروني</label>
                                                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="البريد الإلكتروني">
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label" for="userpassword">كلمة السر</label>
                                                <input type="password" name="password" class="form-control" id="password" placeholder="كلمة السر الجديدة">
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label" for="userpassword">تأكيد كلمة السر</label>
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="تأكيد كلمة السر">
                                            </div>

                                            <div class="d-grid mt-4">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit">إعادة تعيين</button>
                                            </div>
                                            <input type="hidden" value="{{$token}}" name="token" id="token">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <p class="text-white-50">© <script>document.write(new Date().getFullYear())</script> المركز السعودي  </p>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end Account pages -->

        <!-- JAVASCRIPT -->
        <script src="/assets/libs/jquery/jquery.min.js"></script>
        <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/assets/libs/node-waves/waves.min.js"></script>

        <script src="/assets/js/app.js"></script>

    </body>
</html>
