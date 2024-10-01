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

  </style>
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
                    </div>
                </div>
            </div>
        </div>
        <!-- container -->
    </div>

    <form action="" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="full_name" class="form-label">اسم المعيل رباعي </label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="col-md-3">
                <label for="id_num" class="form-label">رقم هوية المعيل </label>
                <input type="text" class="form-control" id="id_num" name="id_num" required>
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
                <input type="number" class="form-control" id="mobile" name="mobile" required>
            </div>
        </div>
        <div class="row mb-3">

            <div class="col-md-3">
                <label for="mobile" class="form-label"> عدد الاناث </label>
                <input type="number" class="form-control" id="mobile" name="mobile" required>
            </div>

            <div class="col-md-3">
                <label for="mobile" class="form-label">عدد الاطفال اقل من سنتين</label>
                <input type="number" class="form-control" id="mobile" name="mobile" required>
            </div>

            <div class="col-md-3">
                <label for="mobile" class="form-label">عدد اطفال اقل من 3 سنوات </label>
                <input type="number" class="form-control" id="mobile" name="mobile" required>
            </div>

            <div class="col-md-3">
                <label for="mobile" class="form-label">عدد الابناء من 5 ل 16 </label>
                <input type="number" class="form-control" id="mobile" name="mobile" required>
            </div>
        </div>

        <div class="row mb-3">

            <div class="col-md-3">
                <label for="marital_status" class="form-label">الوثيقة </label>
                <select class="form-select" id="marital_status" name="marital_status" required>
                    <option value="" disabled selected>اختر  </option>
                    <option value="single"> هوية فلسطينية</option>
                    <option value="married">جواز سفر </option>
                    <option value="divorced">رقم تعريف </option>
                    <option value="widowed">وثيقة اردنية </option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="marital_status" class="form-label">هل المعيل مصاب حرب </label>
                <select class="form-select" id="marital_status" name="marital_status" required>
                    <option value="" disabled selected>اختر  </option>
                    <option value="yes"> نعم </option>
                    <option value="no">لا  </option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="marital_status" class="form-label">هل المعيل ذو اعاقة </label>
                <select class="form-select" id="marital_status" name="marital_status" required>
                    <option value="" disabled selected>اختر  </option>
                    <option value="yes"> نعم </option>
                    <option value="no">لا  </option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="marital_status" class="form-label"> نوع الاعاقة</label>
                <select class="form-select" id="marital_status" name="marital_status" required>
                    <option value="" disabled selected>اختر  </option>
                    <option value="yes">إعاقة بصرية </option>
                    <option value="no">إعاقة سمعية  </option>
                    <option value="no">إعاقة حركية </option>
                    <option value="no"> إعاقة عقلية</option>
                    <option value="no">إعاقة نفسية  </option>
                    <option value="no"> إعاقة نطقية </option>
                    <option value="no">إعاقة اجتماعية (التوحد أو اضطرابات التواصل)</option>
                    <option value="no"> إعاقة حسية</option>
                    <option value="no"> إعاقة متعددة</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">

            <div class="col-md-3">
                <label for="marital_status" class="form-label">لديه امراض مزمنه  </label>
                <select class="form-select" id="marital_status" name="marital_status" required>
                    <option value="" disabled selected>اختر  </option>
                    <option value="single"> نعم </option>
                    <option value="married"> لا </option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="marital_status" class="form-label">هل  يوجد فقيد حرب </label>
                <select class="form-select" id="marital_status" name="marital_status" required>
                    <option value="" disabled selected>اختر  </option>
                    <option value="yes"> نعم </option>
                    <option value="no">لا  </option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="marital_status" class="form-label">هل يوجد مصدر دخل   </label>
                <select class="form-select" id="marital_status" name="marital_status" required>
                    <option value="" disabled selected>اختر  </option>
                    <option value="yes"> نعم </option>
                    <option value="no">لا  </option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="marital_status" class="form-label"> هل المعيل موظف ؟ </label>
                <select class="form-select" id="marital_status" name="marital_status" required>
                    <option value="" disabled selected>اختر  </option>
                    <option value="yes"> نعم </option>
                    <option value="no">لا  </option>
                </select>
            </div>
        </div>


        <div class="row mb-3">
            <div class="col-md-3">
                <label for="mobile" class="form-label">متوسط الدخل </label>
                <input type="number" class="form-control" id="mobile" name="mobile" required>
            </div>

            <div class="col-md-3">
                <label for="marital_status" class="form-label"> المحافظة </label>
                <select class="form-select" id="marital_status" name="marital_status" required>
                    <option value="" disabled selected>اختر  </option>
                    <option value="yes"> شمال غزة </option>
                    <option value="no">غزة </option>
                    <option value="yes"> الوسطى</option>
                    <option value="no">خانيونس</option>
                    <option value="yes">  رفح</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="marital_status" class="form-label"> المدينة </label>
                <select class="form-select" id="marital_status" name="marital_status" required>
                    <option disabled value="">اختر مدينة</option>
                    <option value="غزة">غزة</option>
                    <option value="خان يونس">خان يونس</option>
                    <option value="رفح">رفح</option>
                    <option value="دير البلح">دير البلح</option>
                    <option value="البريج">البريج</option>
                    <option value="جباليا">جباليا</option>
                    <option value="بيت لاهيا">بيت لاهيا</option>
                    <option value="بيت لاهيا">بيت حانون</option>
                    <option value="النصيرات">النصيرات</option>
                    <option value="المغازي">المغازي</option>
                    <option value="المغازي">الزوايدة</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="marital_status" class="form-label"> التجمع السكني </label>
                <select class="form-select" id="marital_status" name="marital_status" required>
                    <option disabled value="">اختر </option>
                    <option value="غزة">خانيونس البلد</option>
                    <option value="خان يونس">مخيم خانيونس </option>
                    <option value="المواصي خانيونس">المواصي خانيونس</option>
                    <option value="بني سهيلا">بني سهيلا</option>
                    <option value="عبسان الكبيرة">عبسان الكبيرة</option>
                    <option value="عبسان الجديدة"> عبسان الجديدة</option>
                    <option value="خزاعة">خزاعة</option>
                    <option value="الفخاري">الفخاري</option>
                    <option value="قرارة">قرارة</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <label for="full_name" class="form-label">الحى</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="col-md-3">
                <label for="full_name" class="form-label">الشارع</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="col-md-3">
                <label for="full_name" class="form-label">اقرب معلم</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="col-md-3">
                <label for="marital_status" class="form-label">نازح / مقيم</label>
                <select class="form-select" id="marital_status" name="marital_status" required>
                    <option disabled value="">اختر </option>
                    <option value="نازح">نازح</option>
                    <option value="مقيم">مقيم</option>
                </select>
            </div>


        </div>


        <div class="row mb-3">

            <div class="col-md-3">
                <label for="marital_status" class="form-label">ملك / إجار</label>
                <select class="form-select" id="marital_status" name="marital_status" required>
                    <option disabled value="">اختر </option>
                    <option value="ملك">ملك</option>
                    <option value="إجار">إجار</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="marital_status" class="form-label">نوع السكن</label>
                <select class="form-select" id="marital_status" name="marital_status" required>
                    <option disabled value="">اختر </option>
                    <option value="ملك">باطون</option>
                    <option value="زينقو">زينقو</option>
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


</body>

</html>
