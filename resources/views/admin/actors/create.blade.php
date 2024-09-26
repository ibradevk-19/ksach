@extends('includes.main')
@section('content')


<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">مندوب جديد</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> الرئيسية</a></li>
                        <li class="breadcrumb-item active">مندوب جديد </li>
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
                    <form action=" {{route('actors.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">الإسم</label>
                        <div class="col-6">
                            <div class="col-md-10">
                                <input class="form-control" placeholder="الإسم" type="text" value="{{old('name')}}" name="name" id="example-text-input">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">رقم الهوية</label>
                        <div class="col-6">
                            <div class="col-md-10">
                                <input class="form-control" placeholder="رقم الهوية" type="text" value="{{old('id_num')}}" name="id_num" id="example-text-input">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">رقم الجوال</label>
                        <div class="col-6">
                            <div class="col-md-10">
                                <input class="form-control" placeholder="رقم الجوال" type="text" value="{{old('mobile_num')}}" name="mobile_num" id="example-text-input">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">العائلة</label>
                        <div class="col-6">
                            <div class="col-md-10">
                                <select id="family_id" name="family_id" class="form-select">
                                    
                                    <option>اختار العائلة</option>
                                    @foreach($families as $item)
                                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
