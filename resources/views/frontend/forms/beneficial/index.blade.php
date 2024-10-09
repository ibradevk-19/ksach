<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <!--====== Required meta tags ======-->
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!--====== Title ======-->
  <title>المركز السعودي للثقافة والتراث</title>
  <!--====== Favicon Icon ======-->
  <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/svg" />

  <!--====== Bootstrap css ======-->
  <link href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
  <!--====== Line Icons css ======-->

  <link href="{{ asset('frontend/assets/css/lineicons.css') }}" rel="stylesheet" type="text/css">
  <!--====== Style css ======-->
  <link href="{{ asset('frontend/assets/scss/starter.css') }}" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="{{ asset('frontend/assets/scss/navbars/navbar-01.css') }}" />
  <link rel="stylesheet" href="{{ asset('frontend/assets/scss/about/about-07.css') }}" />
  <link rel="stylesheet" href="{{ asset('frontend/assets/scss/features/feature-04.css') }}" />
  <link rel="stylesheet" href="{{ asset('frontend/assets/scss/clients/clients-01.css') }}" />
  <link rel="stylesheet" href="{{ asset('frontend/assets/scss/footers/footer-10.css') }}" />
  <link rel="stylesheet" href="{{ asset('frontend/assets/scss/services/service-06.css') }}" />
  <link rel="stylesheet" href="{{ asset('frontend/assets/scss/testimonials/testimonial-05.css') }}" />
  <link rel="stylesheet" href="{{ asset('frontend/assets/scss/blogs/blog-14.css') }}" />
  <link rel="stylesheet" href="{{ asset('frontend/assets/scss/section-title/section-title-04.css') }}" />
  <link rel="stylesheet" href="{{ asset('frontend/assets/scss/contact/contact-08.css') }}" />
  <link rel="stylesheet" href="{{ asset('frontend/assets/scss/section-title/section-title-05.css') }}" />

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
    <!--====== NAVBAR FIVE PART START ======-->

    <section class="navbar-area navbar-one">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg">
              <a class="navbar-brand" href="javascript:void(0)">
                <img src="{{ asset('frontend/assets/images/logo-svg.svg') }}" width="65" height="65" alt="Logo" />
              </a>

              <div class="collapse navbar-collapse sub-menu-bar" id="navbarOne">
                <ul class="navbar-nav m-auto">
                  <li class="nav-item">
                    <a href="https://ksach.org/#about-us">عن المركز</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://ksach.org/#services">الخدمات</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://ksach.org/#projects">المشاريع</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://ksach.org/#news">الاخبار</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://ksach.org/#contact-us">تواصل معنا</a>
                  </li>
                </ul>
              </div>

              <div class="navbar-btn d-none d-sm-inline-block">
                <ul>
                  <li>
                    {{-- <a class="btn primary-btn-outline" href="javascript:void(0)"
                      >ترع الان</a
                    > --}}
                  </li>

                </ul>
              </div>
            </nav>
            <!-- navbar -->
          </div>
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </section>


    <!--====== NAVBAR FIVE PART ENDS ======-->
 <!-- Start About Us Seven -->

 <div class="container">
    <div class="section-title-four">
        <div class="container">
            <div class="row">


                <div class="col-12">

                    <div class="content">

                        <h2 class="fw-bold"> صفحة تسجيل بيانات الاسرة </h2>

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

    <form action="{{ route('beneficial.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="full_name" class="form-label">اسم المعيل رباعي </label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="col-md-3">
                <label for="id_num" class="form-label">رقم هوية المعيل </label>
                <input type="number" min="100000000" min="999999999" class="form-control" id="id_num" name="id_num" required>
            </div>
            <div class="col-md-3">
                <label for="wife_name" class="form-label">اسم الزوجة </label>
                <input type="text" class="form-control" id="wife_name" name="wife_name" >
            </div>
            <div class="col-md-3">
                <label for="wife_id_num" class="form-label">رقم هوية الزوجة</label>
                <input type="number" class="form-control" id="wife_id_num" name="wife_id_num" >
            </div>
        </div>

        <div class="row mb-3">

            <div class="col-md-3">
                <label for="marital_status" class="form-label">الحالة الاجتماعية</label>
                <select class="form-select" id="marital_status" name="marital_status" required>
                    <option value="" disabled selected>اختر الحالة الاجتماعية</option>
                    <option value="single">أعزب</option>
                    <option value="married">متزوج</option>
                    <option value="divorced">مطلق</option>
                    <option value="widowed">أرمل</option>
                    <option value="breadwinner">بلا معيل</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="mobile" class="form-label">رقم الجوال</label>
                <input type="text" class="form-control" id="mobile" name="mobile" required>
            </div>
            <div class="col-md-3">
                <label for="family_count" class="form-label">عدد افراد  </label>
                <input type="number" class="form-control" id="family_count" name="family_count" required>
            </div>
            <div class="col-md-3">
                <label for="mobile" class="form-label">عدد الذكور </label>
                <input type="number" class="form-control" id="male_count" name="male_count" required>
            </div>
        </div>
        <div class="row mb-3">

            <div class="col-md-3">
                <label for="female_count" class="form-label"> عدد الاناث </label>
                <input type="number" class="form-control" id="female_count" name="female_count" required>
            </div>

            <div class="col-md-3">
                <label for="children_under_2" class="form-label">عدد الاطفال اقل من سنتين</label>
                <input type="number" class="form-control" id="children_under_2" name="children_under_2" required>
            </div>

            <div class="col-md-3">
                <label for="children_under_3" class="form-label">عدد اطفال اقل من 3 سنوات </label>
                <input type="number" class="form-control" id="children_under_3" name="children_under_3" required>
            </div>

            <div class="col-md-3">
                <label for="children_5_to_16" class="form-label">عدد الابناء من 5 ل 16 </label>
                <input type="number" class="form-control" id="children_5_to_16" name="children_5_to_16" required>
            </div>
        </div>

        <div class="row mb-3">

            <div class="col-md-3">
                <label for="document" class="form-label">الوثيقة </label>
                <select class="form-select" id="document" name="document" required>
                    <option value="" disabled selected>اختر  </option>
                    <option value="palestinian_identity"> هوية فلسطينية</option>
                    <option value="passport">جواز سفر </option>
                    <option value="identification_number">رقم تعريف </option>
                    <option value="jordanian_document">وثيقة اردنية </option>
                    <option value="other">اخرى</option>

                </select>
            </div>

            <div class="col-md-3">
                <label for="is_breadwinner_disabled" class="form-label">هل المعيل مصاب حرب </label>
                <select class="form-select" id="is_breadwinner_disabled" name="is_breadwinner_disabled" required>
                    <option value="" disabled selected>اختر  </option>
                    <option value="1"> نعم </option>
                    <option value="0">لا  </option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="has_disability" class="form-label">هل المعيل ذو اعاقة </label>
                <select class="form-select" id="has_disability" name="has_disability" required>
                    <option value="" disabled selected>اختر  </option>
                    <option value="1"> نعم </option>
                    <option value="0">لا  </option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="disability_type" class="form-label"> نوع الاعاقة</label>
                <select class="form-select" id="disability_type" name="disability_type" >
                    <option value=""  selected>اختر  </option>
                    <option value="visual_impairment">إعاقة بصرية</option>
                    <option value="hearing_disability">إعاقة سمعية</option>
                    <option value="movement_disability">إعاقة حركية </option>
                    <option value="mental_disability"> إعاقة عقلية</option>
                    <option value="psychological_disability">إعاقة نفسية  </option>
                    <option value="speech_disability"> إعاقة نطقية </option>
                    <option value="social_disability">إعاقة اجتماعية (التوحد أو اضطرابات التواصل)</option>
                    <option value="sensory_impairment"> إعاقة حسية</option>
                    <option value="multiple_disabilities"> إعاقة متعددة</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">

            <div class="col-md-3">
                <label for="has_chronic_disease" class="form-label">لديه امراض مزمنه  </label>
                <select class="form-select" id="has_chronic_disease" name="has_chronic_disease" required>
                    <option value=""  selected>اختر  </option>
                    <option value="1"> نعم </option>
                    <option value="0"> لا </option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="war_victim" class="form-label">هل  يوجد فقيد حرب </label>
                <select class="form-select" id="war_victim" name="war_victim" required>
                    <option value=""  selected>اختر  </option>
                    <option value="1"> نعم </option>
                    <option value="0">لا  </option>
                </select>
            </div>

            {{-- <div class="col-md-3">
                <label for="income_source" class="form-label">هل يوجد مصدر دخل   </label>
                <select class="form-select" id="income_source" name="income_source" required>
                    <option value=""  selected>اختر  </option>
                    <option value="1"> نعم </option>
                    <option value="0">لا  </option>
                </select>
            </div> --}}

            {{-- <div class="col-md-3">
                <label for="is_employee" class="form-label"> هل المعيل موظف ؟ </label>
                <select class="form-select" id="is_employee" name="is_employee" required>
                    <option value=""  selected>اختر  </option>
                    <option value="1"> نعم </option>
                    <option value="0">لا  </option>
                </select>
            </div> --}}
            <div class="col-md-3">
                <label for="province" class="form-label"> المحافظة </label>
                <select class="form-select" id="province" name="province" required>
                    <option value="" disabled selected>اختر  </option>
                    @foreach($provinces as $province)
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="city" class="form-label"> المدينة </label>
                <select class="form-select" id="city" name="city" required>
                    <option disabled value="">اختر مدينة</option>
                </select>
            </div>
        </div>


        <div class="row mb-3">
            {{-- <div class="col-md-3">
                <label for="average_income" class="form-label">متوسط الدخل </label>
                <input type="number" class="form-control" id="average_income" name="average_income" >
            </div> --}}



            <div class="col-md-3">
                <label for="housing_complex" class="form-label"> التجمع السكني </label>
                <select class="form-select" id="housing_complex" name="housing_complex" required>
                    <option disabled value="">اختر </option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="neighborhood" class="form-label">الحى</label>
                <input type="text" class="form-control" id="neighborhood" name="neighborhood" required>
            </div>

            <div class="col-md-3">
                <label for="street" class="form-label">الشارع</label>
                <input type="text" class="form-control" id="street" name="street" required>
            </div>
            <div class="col-md-3">
                <label for="nearest_landmark" class="form-label">اقرب معلم</label>
                <input type="text" class="form-control" id="nearest_landmark" name="nearest_landmark" required>
            </div>
        </div>

        <div class="row mb-3">


            <div class="col-md-3">
                <label for="is_displaced" class="form-label">نازح / مقيم</label>
                <select class="form-select" id="is_displaced" name="is_displaced" required>
                    <option  value="">اختر </option>
                    <option value="3">نازح</option>
                    <option value="1">مقيم</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="is_owner" class="form-label">ملك / إجار</label>
                <select class="form-select" id="is_owner" name="is_owner" required>
                    <option  value="">اختر </option>
                    <option value="1">ملك</option>
                    <option value="0">إجار</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="housing_type" class="form-label">نوع السكن</label>
                <select class="form-select" id="housing_type" name="housing_type" required>
                    <option  value="">اختر </option>
                    <option value="concrete">باطون</option>
                    <option value="asbestos_sheets">زينقو</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="war_damage" class="form-label">هل يوجد أضرار حرب 2023</label>
                <select class="form-select" id="war_damage" name="war_damage" required>
                    <option  value="">اختر </option>
                    <option value="1">نعم</option>
                    <option value="0">لا</option>
                </select>
            </div>
        </div>


        <div class="row mb-3">
            <div class="col-md-3">
                <label for="damage_type" class="form-label">نوع الضرر</label>
                <select class="form-select" id="damage_type" name="damage_type" >
                    <option  value="">اختر </option>
                    <option value="total_damage">ضرر كلي</option>
                    <option value="partial_damage">ضرر جزئي</option>
                    <option value="uninhabitable_part">جزئي غير قابل للسكن</option>
                    <option value="inhabitable_part">جزئي قابل للسكن</option>
                </select>


            </div>
        </div>

    <div class="row" style="margin: 20px">
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">تسجيل</button>

        </div>

    </div>



    </form>
</div>


<!-- /End About Us Area -->


<section class="footer-area footer-ten">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="footer-top-content">
          <div class="footer-logo text-center">
            <a href="javascript:void(0)">
              <img
                src="{{ asset('frontend/assets/images/logo-svg.svg') }}" width="100" height="100"
                alt="Logo"
              />
            </a>
          </div>
          <!-- footer logo -->
          <p class="text-center">
            المركز السعودي للثقافة والتراث
          </p>
          <h5 class="text-center social-title">تابعونا</h5>
          <ul class="social text-center mt-60">
            <li>
              <a href="https://www.facebook.com/saudicenter2005/" target="_blank">
                <i class="lni lni-facebook-filled"></i>
              </a>
            </li>
            <li>
              <a href="https://x.com/saudicenter2005?t=LWLrT0m0Mz-nKqCCyAntgA&s=08" target="_blank">
                <i class="lni lni-twitter-original"></i>
              </a>
            </li>
            <li>
              <a href="https://www.instagram.com/saudicenter2005?igsh=Mmt4eTJqMmlkbnR4" target="_blank">
                <i class="lni lni-instagram-filled"></i>
              </a>
            </li>
          </ul>
          <!-- social -->
        </div>
      </div>
    </div>
    <!-- row -->
  </div>
  <!-- container -->
  <div class="footer-copyright">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="copyright text-center">
            <p class="text">جميع الحقوق محفوظة لدي المركز السعودي للثقافة والتراث</p>
          </div>
          <!--  copyright -->
        </div>
      </div>
    </div>
  </div>
</section>


<script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>


 <!--====== Tiny Slider js ======-->
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
