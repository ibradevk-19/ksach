<!doctype html>
<html lang="ar" dir="rtl" >
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <!-- CSS files -->
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

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  </head>
  <body >
    <script src="{{ asset('frontend/dist/js/demo-theme.min.js?1692870487') }}"></script>
    <div class="page">
      <!-- Navbar -->
      <header class="navbar navbar-expand-md d-print-none" >
        <div class="container-xl">

          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
              <img src="./static/logo.svg" width="110" height="32" alt="المركز السعودي للثقافة و التراث" class="navbar-brand-image">
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
              <div class="btn-list">


              </div>
            </div>
            <div class="d-none d-md-flex">
              <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
              </a>
              <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
              </a>

            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url(./dist/img/menu-2.png)"></span>
                <div class="d-none d-xl-block ps-2">
                    <div>{{ Auth::user()->name }}    </div>
                    <div class="mt-1 small text-secondary">{{ Auth::user()->id_number }}</div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="" class="dropdown-item">تغير كلمة المرور</a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST">
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
                <div class="col-lg-12">
                    <div class="row row-cards">
                      <div class="col-12">
                        <form class="card" action="{{ route('dashboard.user.update') }}" method="POST">
                            @csrf
                          <div class="card-body">
                            <h3 class="card-title">تعديل البيانات</h3>
                            <div class="row row-cards">
                              <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="full_name" class="form-label">اسم المعيل رباعي </label>
                                    <input type="text" disabled class="form-control" value="{{ $beneficial->full_name }}" id="full_name" name="full_name" required>
                                </div>
                              </div>
                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="id_num" class="form-label">رقم هوية المعيل </label>
                                    <input type="number" disabled min="100000000" min="999999999" class="form-control" value="{{ $beneficial->id_num }}" id="id_num" name="id_num" required>
                                </div>
                              </div>
                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="wife_name" class="form-label">اسم الزوجة </label>
                                    <input type="text" disabled class="form-control" id="wife_name" value="{{ $beneficial->wife_name }}" name="wife_name" >
                                </div>
                              </div>
                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="wife_id_num" class="form-label">رقم هوية الزوجة</label>
                                    <input type="number" disabled class="form-control" id="wife_id_num" value="{{ $beneficial->wife_id_num }}" name="wife_id_num" >
                                </div>
                              </div>
                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
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
                              </div>
                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">رقم الجوال</label>
                                    <input type="text" value="{{ $beneficial->mobile }}" class="form-control" id="mobile" name="mobile" required>
                                </div>
                              </div>
                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="family_count" class="form-label">عدد افراد  </label>
                                    <input type="number" value="{{ $beneficial->family_count }}" class="form-control" id="family_count" name="family_count" required>
                                </div>
                              </div>
                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">عدد الذكور </label>
                                    <input type="number" value="{{ $beneficial->familyDetailsInfo?->male_count }}" class="form-control" id="male_count" name="male_count" required>
                                </div>
                              </div>

                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="female_count" class="form-label"> عدد الاناث </label>
                                    <input type="number" value="{{ $beneficial->familyDetailsInfo?->female_count }}" class="form-control" id="female_count" name="female_count" required>
                                </div>
                              </div>

                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="children_under_2" class="form-label">عدد الاطفال اقل من سنتين</label>
                                    <input type="number" class="form-control" value="{{ $beneficial->familyDetailsInfo?->children_under_2 }}"  id="children_under_2" name="children_under_2" required>
                                </div>
                              </div>

                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="children_under_3" class="form-label">عدد اطفال اقل من 3 سنوات </label>
                                    <input type="number" class="form-control" value="{{ $beneficial->familyDetailsInfo?->children_under_3 }}" id="children_under_3" name="children_under_3" required>
                                </div>
                              </div>

                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="children_5_to_16" class="form-label">عدد الابناء من 5 ل 16 </label>
                                     <input type="number" class="form-control" value="{{ $beneficial->familyDetailsInfo?->children_5_to_16 }}" id="children_5_to_16" name="children_5_to_16" required>
                                </div>
                              </div>
                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
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
                              </div>
                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="is_breadwinner_disabled" class="form-label">هل المعيل مصاب حرب </label>
                                    <select class="form-select" id="is_breadwinner_disabled" name="is_breadwinner_disabled" required>
                                        <option value="" disabled selected>اختر  </option>
                                        <option @if ($beneficial->familyDetailsInfo?->is_breadwinner_disabled == '1') selected @endif value="1"> نعم </option>
                                        <option @if ($beneficial->familyDetailsInfo?->is_breadwinner_disabled == '0') selected @endif value="0">لا  </option>
                                    </select>
                                </div>
                              </div>

                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="has_disability" class="form-label">هل المعيل ذو اعاقة </label>
                                    <select class="form-select" id="has_disability" name="has_disability" required>
                                        <option value="" disabled selected>اختر  </option>
                                        <option @if ($beneficial->familyDetailsInfo?->has_disability == '1') selected @endif value="1"> نعم </option>
                                        <option @if ($beneficial->familyDetailsInfo?->has_disability == '0') selected @endif value="0">لا  </option>
                                    </select>
                                </div>
                              </div>

                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
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

                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="has_chronic_disease" class="form-label">لديه امراض مزمنه  </label>
                                    <select class="form-select" id="has_chronic_disease" name="has_chronic_disease" required>
                                        <option value=""  selected>اختر  </option>
                                        <option @if ($beneficial->familyDetailsInfo?->has_chronic_disease == '1') selected @endif value="1"> نعم </option>
                                        <option @if ($beneficial->familyDetailsInfo?->has_chronic_disease == '0') selected @endif value="0"> لا </option>
                                    </select>
                                </div>
                              </div>

                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="war_victim" class="form-label">هل  يوجد فقيد حرب </label>
                                    <select class="form-select" id="war_victim" name="war_victim" required>
                                        <option value=""  selected>اختر  </option>
                                        <option @if ($beneficial->familyDetailsInfo?->war_victim == '1') selected @endif value="1"> نعم </option>
                                        <option @if ($beneficial->familyDetailsInfo?->war_victim == '0') selected @endif value="0">لا  </option>
                                    </select>
                                </div>
                              </div>

                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="province" class="form-label"> المحافظة </label>
                                    <select class="form-select" id="province" name="province" required>
                                        <option value="" disabled selected>اختر  </option>
                                        @foreach($provinces as $province)
                                            <option @if ($beneficial->familyDetailsInfo?->province == $province->id) selected @endif value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                              </div>

                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="city" class="form-label"> المدينة </label>
                                    <select class="form-select" id="city" name="city" required>
                                        <option disabled value="">اختر مدينة</option>
                                        @foreach($cities as $city)
                                        <option @if ($beneficial->familyDetailsInfo?->city == $city->id) selected @endif value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                              </div>

                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="housing_complex" class="form-label"> التجمع السكني </label>
                                    <select class="form-select" id="housing_complex" name="housing_complex" required>
                                        <option disabled value="">اختر </option>
                                        @foreach($housing_complexs as $housing_complex)
                                           <option @if ($beneficial->familyDetailsInfo?->housing_complex == $housing_complex->id) selected @endif value="{{ $housing_complex->id }}">{{ $housing_complex->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                              </div>

                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="neighborhood" class="form-label">الحى</label>
                                    <input type="text" value="{{ $beneficial->familyDetailsInfo?->neighborhood }}" class="form-control" id="neighborhood" name="neighborhood" required>
                                </div>
                              </div>

                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="street" class="form-label">الشارع</label>
                                    <input type="text" value="{{ $beneficial->familyDetailsInfo?->street }}" class="form-control" id="street" name="street" required>
                                </div>
                              </div>

                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="nearest_landmark" class="form-label">اقرب معلم</label>
                    <input type="text" value="{{ $beneficial->familyDetailsInfo?->nearest_landmark }}" class="form-control" id="nearest_landmark" name="nearest_landmark" required>
                                </div>
                              </div>

                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="is_displaced" class="form-label">نازح / مقيم</label>
                                    <select class="form-select" id="is_displaced" name="is_displaced" required>
                                        <option  value="">اختر </option>
                                        <option @if ($beneficial->familyDetailsInfo?->is_displaced == '0') selected @endif value="0">نازح</option>
                                        <option @if ($beneficial->familyDetailsInfo?->is_displaced == '1') selected @endif value="1">مقيم</option>
                                    </select>
                                </div>
                              </div>

                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="is_owner" class="form-label">ملك / إجار</label>
                                    <select class="form-select" id="is_owner" name="is_owner" required>
                                        <option  value="">اختر </option>
                                        <option @if ($beneficial->familyDetailsInfo?->is_owner == '1') selected @endif value="1">ملك</option>
                                        <option @if ($beneficial->familyDetailsInfo?->is_owner == '0') selected @endif value="0">إجار</option>
                                    </select>
                                </div>
                              </div>

                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="housing_type" class="form-label">نوع السكن</label>
                                    <select class="form-select" id="housing_type" name="housing_type" required>
                                        <option  value="">اختر </option>
                                        <option @if ($beneficial->familyDetailsInfo?->housing_type == 'concrete') selected @endif value="concrete">باطون</option>
                                        <option @if ($beneficial->familyDetailsInfo?->housing_type == 'asbestos_sheets') selected @endif  value="asbestos_sheets">زينقو</option>
                                    </select>
                                </div>
                              </div>
                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label for="war_damage" class="form-label">هل يوجد أضرار حرب 2023</label>
                                    <select class="form-select" id="war_damage" name="war_damage" required>
                                        <option  value="">اختر </option>
                                        <option  @if ($beneficial->familyDetailsInfo?->war_damage == '1') selected @endif value="1">نعم</option>
                                        <option  @if ($beneficial->familyDetailsInfo?->war_damage == '0') selected @endif value="0">لا</option>
                                    </select>
                                </div>
                              </div>
                              <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
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
                            </div>
                          </div>
                          <div class="card-footer text-start">
                            <button type="submit" class="btn btn-primary">تعديل</button>
                          </div>
                        </form>
                      </div>

                    </div>
                  </div>
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
