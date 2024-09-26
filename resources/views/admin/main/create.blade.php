@extends('includes.main')
@section('content')


<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">مستفيد جديد</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> الرئيسية</a></li>
                        <li class="breadcrumb-item active">مستفيد جديد </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
            @csrf
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action=" {{route('admin.main.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="mb-3 row">
                        <label for="full_name" class="col-md-2 col-form-label">الإسم</label>
                        <div class="col-md-5">
                            <input class="form-control" placeholder="الإسم" type="text" value="{{old('full_name')}}" name="full_name" id="full_name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="id_num" class="col-md-2 col-form-label">رقم الهوية</label>
                        <div class="col-md-5">
                            <input class="form-control" placeholder="رقم الهوية" type="text" value="{{old('id_num')}}" name="id_num" id="id_num">
                        </div>
                        <div class="col-md-2">
                                <a href="javascript:void(0)" class=" btn btn-primary waves-effect waves-light btn-sm " onclick="checkIdNumber()">
                                <i class=" ri-eye-line align-middle me-2"></i>
                                    فحص
                                </a>

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="wife_name" class="col-md-2 col-form-label">اسم الزوجة</label>
                        <div class="col-md-5">
                            <input class="form-control" placeholder="اسم الزوجة" type="text" value="{{old('wife_name')}}" name="wife_name" id="wife_name">
                        </div>
                       
                    </div>
                    <div class="mb-3 row">
                        <label for="wife_id_num" class="col-md-2 col-form-label">رقم الهوية الزوجة</label>
                        <div class="col-md-5">
                            <input class="form-control" placeholder="رقم الهوية الزوجة" type="text" value="{{old('wife_id_num')}}" name="wife_id_num" id="wife_id_num">
                        </div>
                        <div class="col-md-2">
                                <a href="javascript:void(0)" class=" btn btn-primary waves-effect waves-light btn-sm " onclick="checkIdNumberwife()">
                                <i class=" ri-eye-line align-middle me-2"></i>
                                    فحص
                                </a>

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">رقم الجوال </label>
                        <div class="col-md-5">
                            <input class="form-control" placeholder="رقم الجوال " type="text" value="{{old('mobile')}}" name="mobile" id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label"> الحالة الاجتماعية </label>
                        <div class="col-md-5">
                          <select name="marital_status" class="form-select">
                               <option>اختار الحالة الاجتماعية</option>
                                  <option value="1">اعزب</option>
                                  <option value="2">متزوج</option>
                                  <option value="3">مطلق</option>
                                  <option value="4">ارملة</option>
                                  <option value="5">ارمل</option>
                                  <option value="6">حالة اجتماعية</option>
                                  <option value="7">اخر</option>
                           </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label"> عدد الافراد  </label>
                        <div class="col-md-5">
                            <input class="form-control" placeholder=" عدد الافراد " type="number" value="{{old('family_count')}}" name="family_count" id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label"> العائلة</label>
                        <div class="col-md-5">
                          <select id="family_id" name="family_id" class="form-select">
                               <option>اختار العائلة </option>
                               @foreach($families as $family)
                                  <option value="{{$family->id}}">{{ $family->name }}</option>
                               @endforeach 
                                
                           </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">  المندوب </label>
                        <div class="col-md-5">
                          <select id="actor_id" name="actor_id" class="form-select">
                               <option>اختار المندوب </option>
                               @foreach($actors as $actor)
                                  <option value="{{$actor->id}}">{{ $actor->name }}</option>
                               @endforeach   
                           </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit"  class="btn btn-primary disabled_button_click">إضافة</button>
                    </div>
                </form>
                </div>
            </div>

        </div> <!-- end col -->



    </div>


</div>
@endsection
@section('scripts.center')
<script src="{{asset('assets/libs/axios/dist/axios.min.js')}}"></script>

    <script>


    function checkIdNumber() {
        var id = document.getElementById('id_num').value;
         // Make a request for a user with a given ID
         return axios.get(`check_number/` +id)
                    .then(function (response) {
                        if(response.data.data.full_name){
                            var id = document.getElementById('full_name').value = response.data.data.full_name ;
                        }else{
                            var id = document.getElementById('full_name').value = 'لا يوجد له بيانات' ;
                        }
                        console.log(response.data.data.full_name);
                    })
    }

    function checkIdNumberwife() {
        var id = document.getElementById('wife_id_num').value;
         // Make a request for a user with a given ID
         return axios.get(`check_number/` +id)
                    .then(function (response) {
                        if(response.data.data.full_name){
                            var id = document.getElementById('wife_name').value = response.data.data.full_name ;
                        }else{
                            var id = document.getElementById('wife_name').value = 'لا يوجد له بيانات' ;
                        }
                        console.log(response.data.data.full_name);
                    })
    }

    
    </script>
@endsection
