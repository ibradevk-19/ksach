@extends('includes.main')
@section('content')


<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">تعديل مستفيد</h4>
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
                        <label for="example-text-input" class="col-md-2 col-form-label">الإسم</label>
                        <div class="col-md-5">
                            <input class="form-control" placeholder="الإسم" type="text" value="{{ $obj->full_name }}" name="full_name" id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">رقم الهوية</label>
                        <div class="col-md-5">
                            <input class="form-control" placeholder="رقم الهوية" type="text" value="{{ $obj->id_num }}" name="id_num" id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">اسم الزوجة</label>
                        <div class="col-md-5">
                            <input class="form-control" placeholder="اسم الزوجة" type="text" value="{{ $obj->wife_name }}" name="wife_name" id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">رقم الهوية الزوجة</label>
                        <div class="col-md-5">
                            <input class="form-control" placeholder="رقم الهوية الزوجة" type="text" value="{{ $obj->wife_id_num }}" name="wife_id_num" id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">رقم الجوال </label>
                        <div class="col-md-5">
                            <input class="form-control" placeholder="رقم الجوال " type="text" value="{{ $obj->mobile }}" name="mobile" id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label"> الحالة الاجتماعية </label>
                        <div class="col-md-5">
                          <select name="marital_status" class="form-select">
                               <option>اختار الحالة الاجتماعية</option>
                                  <option value="1" {{$obj->marital_status == '1' ? 'selected' : ''}}>اعزب</option>
                                  <option value="2" {{$obj->marital_status == '2' ? 'selected' : ''}}>متزوج</option>
                                  <option value="3" {{$obj->marital_status == '3' ? 'selected' : ''}}>مطلق</option>
                                  <option value="4" {{$obj->marital_status == '4' ? 'selected' : ''}}>ارملة</option>
                                  <option value="5" {{$obj->marital_status == '5' ? 'selected' : ''}}>ارمل</option>
                                  <option value="6" {{$obj->marital_status == '6' ? 'selected' : ''}}>حالة اجتماعية</option>
                                  <option value="7" {{$obj->marital_status == '7' ? 'selected' : ''}}>اخر</option>
                           </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label"> عدد الافراد  </label>
                        <div class="col-md-5">
                            <input class="form-control" placeholder=" عدد الافراد " type="number" value="{{ $obj->family_count }}" name="family_count" id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">  العائلة </label>
                        <div class="col-md-5">
                          <select name="family_id" class="form-select">
                               <option>اختار العائلة </option>
                               @foreach($families as $family)
                                  <option value="{{$family->id}}" {{ $obj->family_id == $family->id ? 'selected' : ''}}>{{ $family->name }}</option>
                               @endforeach 
                                
                           </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">  المندوب </label>
                        <div class="col-md-5">
                          <select name="actor_id" class="form-select">
                               <option>اختار المندوب </option>
                               @foreach($actors as $actor)
                                  <option   value="{{$actor->id}}" {{ $obj->actor_id == $actor->id ? 'selected' : ''}}> {{ $actor->name }}</option>
                               @endforeach   
                           </select>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{$obj->id}}" id="">

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
