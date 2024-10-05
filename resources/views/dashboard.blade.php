<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
    <!-- Bootstrap RTL CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        /* Styling for the dashboard */
        body {
            font-family: 'Cairo', sans-serif;
            direction: rtl; /* Set RTL direction */
            text-align: right; /* Align text to the right */
        }

        .container-fluid {
            padding: 20px;
        }

        .navbar-brand {
            font-size: 1.5rem;
        }

        /* Ensuring a bit of margin between cards and responsiveness */
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">المركز السعودي للثقافة و التراث</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                <!-- Display User's Name -->
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!-- Display the authenticated user's name -->
                            {{ Auth::user()->name }} <!-- اسم المستخدم -->

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><hr class="dropdown-divider"></li>
                            <!-- Logout functionality -->
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit">تسجيل الخروج</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-4">
                <h1 class="mt-4 text-center mb-4">مرحباً بك في المركز السعودي للثقافة و الثرات </h1>
                <p class="text-center mb-4">هذه هي لوحة التحكم الخاصة بك. يمكنك الاطلاع على موعد الدورة الخاصة بك و تعديل بيانات الاسرة و الاطفال و تعديل المندوب الخاص بك.</p>
            </div>
        </br></br></br>
        </div>
        <!-- Dashboard Cards -->
        <div class="row">
            <!-- Responsive Columns for small devices -->
            <div class="col-md-4 col-sm-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">تعديل البيانات الاسرى </h5>
                        <a href="#" class="btn btn-primary">تعديل </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">  اضافة بيانات الاطفال </h5>
                        <a href="#" class="btn btn-primary">اضافة </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">تعديل  المندوب </h5>
                        <a href="#" class="btn btn-primary">تعديل </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card with a Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">دورة المساعدات</h5>
            </div>
            <div class="card-body">
                <!-- Responsive table inside card -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>نوع المساعدة</th>
                                <th>التاريخ </th>
                                <th>المندوب</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($beneficial->deliveryRecordBeneficials as $item)
                                <tr>
                                    <td>1</td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->product->name ?? 'No product available' }}</td>
                                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $beneficial->actor->name ?? 'No actor available' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">لم يتم العثور على سجلات التسليم</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>


    </div>

    <!-- Bootstrap JS and Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
