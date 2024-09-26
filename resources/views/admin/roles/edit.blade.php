@extends('includes.main')
@section('content')


<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">تعديل إذن</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> الرئيسية</a></li>
                        <li class="breadcrumb-item active">تعديل إذن </li>
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
                            <input class="form-control" placeholder="الإسم" type="text" value="{{old('name') ?old('name') : $obj->name}}" name="name" id="example-text-input">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">الحالة</label>
                        <div class="col-md-10">
                            <select name="status" class="form-select">

                                <option value="1"{{(old('status') ? old('status') : $obj->status) == '1' ? 'selected' : ''}} >فعّالة</option>
                                <option value="0" {{(old('status') ? old('status') : $obj->status) == '0' ? 'selected' : ''}}>غير فعّالة</option>
                            </select>
                        </div>
                    </div>


                    <hr>
                    <div class="mb-3 row">


                        @foreach ($permissions as $item)


                        <div style="padding-bottom: 10px" class="col-md-6">
                                <input type="checkbox" value="{{$item->id}}" name="permissions[]" class="form-check-input" id="customCheck{{$item->id}}"
                                @if(old('permissions'))
                                    {{in_array($item->id,old('permissions')) ? 'checked' : ''}}
                                 @else
                                 {{in_array($item->name,$names) ? 'checked' : ''}}


                                    @endif>
                                <label class="form-check-label" for="customCheck{{$item->id}}">{{$item->name_ar}}</label>
                        </div>

                        @endforeach


                    </div>
                    <input type="hidden" value="admin" name="guard_name">
                    <input type="hidden" name="id" value="{{$obj->id}}">
                    <div class="col-12">
                        <button type="submit"  class="btn btn-primary disabled_button_click">تعديل</button>
                    </div>
                </form>
                </div>
            </div>

        </div> <!-- end col -->



    </div>


</div>
@endsection
