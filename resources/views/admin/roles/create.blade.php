@extends('includes.main')
@section('content')


<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">إذن جديد</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> الرئيسية</a></li>
                        <li class="breadcrumb-item active">إذن جديد </li>
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
                    <form action=" {{route('roles.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">الإسم</label>
                        <div class="col-md-10">
                            <input class="form-control" placeholder="الإسم" type="text" value="{{old('name')}}" name="name" id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">الحالة</label>
                        <div class="col-md-10">
                            <select name="status" class="form-select">

                                <option {{old('status')=='1' ? 'selected' : ''}} value="1">فعّالة</option>
                                <option  {{old('status')=='0' ? 'selected' : ''}} value="0">غير فعّالة</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-3 row">

                        @php
                        // dd(old('permissions'));
                            $data_permissions = [];
                            if(old('permissions')){
                                $data_permissions = old('permissions');
                            }
                            // dd($data_permissions);
                        @endphp

                        @foreach ($permissions as $item)
                        <div style="padding-bottom: 10px" class="col-md-6">
                            <input type="checkbox" value="{{$item->id}}" {{in_array($item->id,$data_permissions) ? 'checked' : ''}} name="permissions[]" class="form-check-input" id="customCheck{{$item->id}}" >
                            <label class="form-check-label" for="customCheck{{$item->id}}">{{$item->name_ar}}</label>
                        </div>
                        @endforeach





                    </div>
                    <input type="hidden" value="admin" name="guard_name">
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
