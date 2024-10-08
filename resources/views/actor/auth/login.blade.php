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
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        body {
            background-color: #f8f9fa; /* خلفية الصفحة */
            height: 100vh; /* تعيين ارتفاع الجسم إلى ارتفاع الشاشة */
            display: flex; /* استخدام flexbox */
            justify-content: center; /* محاذاة المحتوى في المنتصف أفقياً */
            align-items: center; /* محاذاة المحتوى في المنتصف عمودياً */
            margin: 0; /* إزالة الهامش الافتراضي */
            font-family: 'Cairo', sans-serif;
            direction: rtl; /* Set RTL direction */
            text-align: right; /* Align text to the right */
        }

        .text-center {
            font-family: 'Cairo', sans-serif;
        }
        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            /* تحسينات لـ Mobile */
            max-width: 400px; /* الحد الأقصى لعرض الحاوية */
            width: 100%; /* استخدام كامل العرض */
        }

        .logo {
            width: 150px; /* عرض الشعار */
            margin-bottom: 20px; /* المسافة أسفل الشعار */
        }

        .institution-name {
            font-size: 1.5rem; /* حجم اسم المؤسسة */
            margin-bottom: 20px; /* المسافة أسفل اسم المؤسسة */
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Add Logo and Institution Name -->
        <div class="text-center">
            <img src="{{ asset('/frontend/assets/logo.svg') }}" alt="شعار المؤسسة" class="logo">
            {{-- <div class="institution-name">المركز السعودي للثقافة والثرات</div> --}}
        </div>
        <h3 class="text-center">تسجيل الدخول</h3>
        @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form method="POST" action="{{ route('actor.login.post') }}">
            @csrf
            <div class="mb-3">
                <label for="id_number" class="form-label">رقم الهوية</label>
                <input type="text" name="id_num" class="form-control" id="id_num" value="{{ old('id_num') }}" required>

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">كلمة المرور</label>
                <input type="password" name="password" class="form-control" id="password" required>

            </div>
            <button type="submit" class="btn btn-primary w-100">تسجيل الدخول</button>


        </form>
    </div>
</body>

</html>
