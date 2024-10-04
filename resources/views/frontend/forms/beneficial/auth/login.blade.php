<!DOCTYPE html>
<html lang="ar" dir="rtl">

    <head>
        <meta charset="UTF-8">

        <title>تسجيل الدخول - المركز السعودي</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap-rtl.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />


        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <h3 class="text-center">User Login</h3>
                    <form method="POST" action="{{ route('login.custom') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="id_number" class="form-label">Phone Number</label>
                            <input type="text" name="id_number" class="form-control" id="id_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>
