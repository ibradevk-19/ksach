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
      <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
          </style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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



    <div class="container-fluid">
        <div class="section-title-four">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="content">
                                @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-info">
                                        {{ session('error') }}
                                    </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- container -->
        </div>

        <form action="{{ route('dashboard.user.update') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="full_name" class="form-label">اسم المعيل رباعي </label>
                    <input type="text" disabled class="form-control" value="{{ $beneficial->full_name }}" id="full_name" name="full_name" required>
                </div>
                <div class="col-md-3">
                    <label for="id_num" class="form-label">رقم هوية المعيل </label>
                    <input type="number" disabled min="100000000" min="999999999" class="form-control" value="{{ $beneficial->id_num }}" id="id_num" name="id_num" required>
                </div>
                <div class="col-md-3">
                    <label for="wife_name" class="form-label">اسم الزوجة </label>
                    <input type="text" disabled class="form-control" id="wife_name" value="{{ $beneficial->wife_name }}" name="wife_name" >
                </div>
                <div class="col-md-3">
                    <label for="wife_id_num" class="form-label">رقم هوية الزوجة</label>
                    <input type="number" disabled class="form-control" id="wife_id_num" value="{{ $beneficial->wife_id_num }}" name="wife_id_num" >
                </div>
            </div>
            <div class="row mb-3">

                <div class="col-md-3">
                    <label for="marital_status" class="form-label">الحالة الاجتماعية</label>
                    <select class="form-select" id="marital_status" name="marital_status" required>
                        <option value="" disabled selected>اختر الحالة الاجتماعية</option>

                        <option @if ($beneficial->familyDetailsInfo?->marital_status == 'single') selected @endif value="single">أعزب</option>
                        <option @if ($beneficial->familyDetailsInfo?->marital_status == 'married') selected @endif value="married">متزوج</option>
                        <optionv @if ($beneficial->familyDetailsInfo?->marital_status == 'divorced') selected @endif value="divorced">مطلق</option>
                        <option @if ($beneficial->familyDetailsInfo?->marital_status == 'widowed') selected @endif value="widowed">أرمل</option>
                        <option @if ($beneficial->familyDetailsInfo?->marital_status == 'breadwinner') selected @endif value="breadwinner">بلا معيل</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="mobile" class="form-label">رقم الجوال</label>
                    <input type="text" value="{{ $beneficial->mobile }}" class="form-control" id="mobile" name="mobile" required>
                </div>
                <div class="col-md-3">
                    <label for="family_count" class="form-label">عدد افراد  </label>
                    <input type="number" value="{{ $beneficial->family_count }}" class="form-control" id="family_count" name="family_count" required>
                </div>
                <div class="col-md-3">
                    <label for="mobile" class="form-label">عدد الذكور </label>
                    <input type="number" value="{{ $beneficial->familyDetailsInfo?->male_count }}" class="form-control" id="male_count" name="male_count" required>
                </div>
            </div>
            <div class="row mb-3">

                <div class="col-md-3">
                    <label for="female_count" class="form-label"> عدد الاناث </label>
                    <input type="number" value="{{ $beneficial->familyDetailsInfo?->female_count }}" class="form-control" id="female_count" name="female_count" required>
                </div>

                <div class="col-md-3">
                    <label for="children_under_2" class="form-label">عدد الاطفال اقل من سنتين</label>
                    <input type="number" class="form-control" value="{{ $beneficial->familyDetailsInfo?->children_under_2 }}"  id="children_under_2" name="children_under_2" required>
                </div>

                <div class="col-md-3">
                    <label for="children_under_3" class="form-label">عدد اطفال اقل من 3 سنوات </label>
                    <input type="number" class="form-control" value="{{ $beneficial->familyDetailsInfo?->children_under_3 }}" id="children_under_3" name="children_under_3" required>
                </div>

                <div class="col-md-3">
                    <label for="children_5_to_16" class="form-label">عدد الابناء من 5 ل 16 </label>
                    <input type="number" class="form-control" value="{{ $beneficial->familyDetailsInfo?->children_5_to_16 }}" id="children_5_to_16" name="children_5_to_16" required>
                </div>
            </div>

            <div class="row mb-3">

                <div class="col-md-3">
                    <label for="document" class="form-label">الوثيقة </label>
                    <select class="form-select" id="document" name="document" required>
                        <option value="" disabled selected>اختر  </option>
                        <option @if ($beneficial->familyDetailsInfo?->document == 'palestinian_identity') selected @endif value="palestinian_identity"> هوية فلسطينية</option>
                        <option @if ($beneficial->familyDetailsInfo?->document == 'passport') selected @endif value="passport">جواز سفر </option>
                        <option @if ($beneficial->familyDetailsInfo?->document == 'identification_number') selected @endif value="identification_number">رقم تعريف </option>
                        <option @if ($beneficial->familyDetailsInfo?->document == 'jordanian_document') selected @endif value="jordanian_document">وثيقة اردنية </option>
                        <option @if ($beneficial->familyDetailsInfo?->document == 'other') selected @endif value="other">اخرى</option>

                    </select>
                </div>

                <div class="col-md-3">
                    <label for="is_breadwinner_disabled" class="form-label">هل المعيل مصاب حرب </label>
                    <select class="form-select" id="is_breadwinner_disabled" name="is_breadwinner_disabled" required>
                        <option value="" disabled selected>اختر  </option>
                        <option @if ($beneficial->familyDetailsInfo?->is_breadwinner_disabled == '1') selected @endif value="1"> نعم </option>
                        <option @if ($beneficial->familyDetailsInfo?->is_breadwinner_disabled == '0') selected @endif value="0">لا  </option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="has_disability" class="form-label">هل المعيل ذو اعاقة </label>
                    <select class="form-select" id="has_disability" name="has_disability" required>
                        <option value="" disabled selected>اختر  </option>
                        <option @if ($beneficial->familyDetailsInfo?->has_disability == '1') selected @endif value="1"> نعم </option>
                        <option @if ($beneficial->familyDetailsInfo?->has_disability == '0') selected @endif value="0">لا  </option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="disability_type" class="form-label"> نوع الاعاقة</label>
                    <select class="form-select" id="disability_type" name="disability_type" >
                        <option value=""  selected>اختر  </option>
                        <option @if ($beneficial->familyDetailsInfo?->disability_type == 'visual_impairment') selected @endif value="visual_impairment">إعاقة بصرية</option>
                        <option @if ($beneficial->familyDetailsInfo?->disability_type == 'hearing_disability') selected @endif value="hearing_disability">إعاقة سمعية</option>
                        <option @if ($beneficial->familyDetailsInfo?->disability_type == 'movement_disability') selected @endif value="movement_disability">إعاقة حركية </option>
                        <option @if ($beneficial->familyDetailsInfo?->disability_type == 'mental_disability') selected @endif value="mental_disability"> إعاقة عقلية</option>
                        <option @if ($beneficial->familyDetailsInfo?->disability_type == 'psychological_disability') selected @endif value="psychological_disability">إعاقة نفسية  </option>
                        <option @if ($beneficial->familyDetailsInfo?->disability_type == 'speech_disability') selected @endif value="speech_disability"> إعاقة نطقية </option>
                        <option @if ($beneficial->familyDetailsInfo?->disability_type == 'social_disability') selected @endif value="social_disability">إعاقة اجتماعية (التوحد أو اضطرابات التواصل)</option>
                        <option @if ($beneficial->familyDetailsInfo?->disability_type == 'sensory_impairment') selected @endif value="sensory_impairment"> إعاقة حسية</option>
                        <option @if ($beneficial->familyDetailsInfo?->disability_type == 'multiple_disabilities') selected @endif value="multiple_disabilities"> إعاقة متعددة</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">

                <div class="col-md-3">
                    <label for="has_chronic_disease" class="form-label">لديه امراض مزمنه  </label>
                    <select class="form-select" id="has_chronic_disease" name="has_chronic_disease" required>
                        <option value=""  selected>اختر  </option>
                        <option @if ($beneficial->familyDetailsInfo?->has_chronic_disease == '1') selected @endif value="1"> نعم </option>
                        <option @if ($beneficial->familyDetailsInfo?->has_chronic_disease == '0') selected @endif value="0"> لا </option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="war_victim" class="form-label">هل  يوجد فقيد حرب </label>
                    <select class="form-select" id="war_victim" name="war_victim" required>
                        <option value=""  selected>اختر  </option>
                        <option @if ($beneficial->familyDetailsInfo?->war_victim == '1') selected @endif value="1"> نعم </option>
                        <option @if ($beneficial->familyDetailsInfo?->war_victim == '0') selected @endif value="0">لا  </option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="income_source" class="form-label">هل يوجد مصدر دخل   </label>
                    <select class="form-select" id="income_source" name="income_source" required>
                        <option value=""  selected>اختر  </option>
                        <option @if ($beneficial->familyDetailsInfo?->income_source == '1') selected @endif value="1"> نعم </option>
                        <option @if ($beneficial->familyDetailsInfo?->income_source == '0') selected @endif value="0">لا  </option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="is_employee" class="form-label"> هل المعيل موظف ؟ </label>
                    <select class="form-select" id="is_employee" name="is_employee" required>
                        <option value=""  selected>اختر  </option>
                        <option @if ($beneficial->familyDetailsInfo?->is_employee == '1') selected @endif value="1"> نعم </option>
                        <option @if ($beneficial->familyDetailsInfo?->is_employee == '0') selected @endif value="0">لا  </option>
                    </select>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="average_income" class="form-label">متوسط الدخل </label>
                    <input type="number" value="{{ $beneficial->familyDetailsInfo?->average_income }}" class="form-control" id="average_income" name="average_income" >
                </div>

                <div class="col-md-3">
                    <label for="province" class="form-label"> المحافظة </label>
                    <select class="form-select" id="province" name="province" required>
                        <option value="" disabled selected>اختر  </option>
                        @foreach($provinces as $province)
                            <option @if ($beneficial->familyDetailsInfo?->province == $province->id) selected @endif value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="city" class="form-label"> المدينة </label>
                    <select class="form-select" id="city" name="city" required>
                        <option disabled value="">اختر مدينة</option>
                        @foreach($cities as $city)
                           <option @if ($beneficial->familyDetailsInfo?->city == $city->id) selected @endif value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="housing_complex" class="form-label"> التجمع السكني </label>
                    <select class="form-select" id="housing_complex" name="housing_complex" required>
                        <option disabled value="">اختر </option>
                        @foreach($housing_complexs as $housing_complex)
                           <option @if ($beneficial->familyDetailsInfo?->housing_complex == $housing_complex->id) selected @endif value="{{ $housing_complex->id }}">{{ $housing_complex->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="neighborhood" class="form-label">الحى</label>
                    <input type="text" value="{{ $beneficial->familyDetailsInfo?->neighborhood }}" class="form-control" id="neighborhood" name="neighborhood" required>
                </div>
                <div class="col-md-3">
                    <label for="street" class="form-label">الشارع</label>
                    <input type="text" value="{{ $beneficial->familyDetailsInfo?->street }}" class="form-control" id="street" name="street" required>
                </div>
                <div class="col-md-3">
                    <label for="nearest_landmark" class="form-label">اقرب معلم</label>
                    <input type="text" value="{{ $beneficial->familyDetailsInfo?->nearest_landmark }}" class="form-control" id="nearest_landmark" name="nearest_landmark" required>
                </div>
                <div class="col-md-3">
                    <label for="is_displaced" class="form-label">نازح / مقيم</label>
                    <select class="form-select" id="is_displaced" name="is_displaced" required>
                        <option  value="">اختر </option>
                        <option @if ($beneficial->familyDetailsInfo?->is_displaced == '0') selected @endif value="0">نازح</option>
                        <option @if ($beneficial->familyDetailsInfo?->is_displaced == '1') selected @endif value="1">مقيم</option>
                    </select>
                </div>


            </div>


            <div class="row mb-3">

                <div class="col-md-3">
                    <label for="is_owner" class="form-label">ملك / إجار</label>
                    <select class="form-select" id="is_owner" name="is_owner" required>
                        <option  value="">اختر </option>
                        <option @if ($beneficial->familyDetailsInfo?->is_owner == '1') selected @endif value="1">ملك</option>
                        <option @if ($beneficial->familyDetailsInfo?->is_owner == '0') selected @endif value="0">إجار</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="housing_type" class="form-label">نوع السكن</label>
                    <select class="form-select" id="housing_type" name="housing_type" required>
                        <option  value="">اختر </option>
                        <option @if ($beneficial->familyDetailsInfo?->housing_type == 'concrete') selected @endif value="concrete">باطون</option>
                        <option @if ($beneficial->familyDetailsInfo?->housing_type == 'asbestos_sheets') selected @endif  value="asbestos_sheets">زينقو</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="war_damage" class="form-label">هل يوجد أضرار حرب 2023</label>
                    <select class="form-select" id="war_damage" name="war_damage" required>
                        <option  value="">اختر </option>
                        <option  @if ($beneficial->familyDetailsInfo?->war_damage == '1') selected @endif value="1">نعم</option>
                        <option  @if ($beneficial->familyDetailsInfo?->war_damage == '0') selected @endif value="0">لا</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="damage_type" class="form-label">نوع الضرر</label>
                    <select class="form-select" id="damage_type" name="damage_type" >
                        <option  value="">اختر </option>
                        <option @if ($beneficial->familyDetailsInfo?->damage_type == 'total_damage') selected @endif value="total_damage">ضرر كلي</option>
                        <option @if ($beneficial->familyDetailsInfo?->damage_type == 'partial_damage') selected @endif value="partial_damage">ضرر جزئي</option>
                        <option @if ($beneficial->familyDetailsInfo?->damage_type == 'uninhabitable_part') selected @endif value="uninhabitable_part">جزئي غير قابل للسكن</option>
                        <option @if ($beneficial->familyDetailsInfo?->damage_type == 'inhabitable_part') selected @endif value="inhabitable_part">جزئي قابل للسكن</option>
                    </select>


                </div>
            </div>

        <div class="row" style="margin: 20px">
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">تعديل</button>

            </div>

        </div>



        </form>
    </div>

    <!-- Bootstrap JS and Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>

        $(document).ready(function () {
            $('#province').on('change', function () {
                var provinceId = $(this).val();
                if (provinceId) {
                    $.ajax({
                        url: '/get-cities/' + provinceId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('#city').empty();
                            $('#city').append('<option disabled selected>اختر مدينة</option>');
                            $.each(data, function (key, value) {
                                $('#city').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });

            $('#city').on('change', function () {
                var cityId = $(this).val();
                if (cityId) {
                    $.ajax({
                        url: '/get-housing-complexes/' + cityId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('#housing_complex').empty();
                            $('#housing_complex').append('<option disabled selected>اختر</option>');
                            $.each(data, function (key, value) {
                                $('#housing_complex').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });
        });

         </script>

</body>
</html>
