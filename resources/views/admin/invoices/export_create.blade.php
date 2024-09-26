@extends('includes.main')
@section('content')


<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">فاتورة تصدير جديده</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> الرئيسية</a></li>
                        <li class="breadcrumb-item active">فاتورة تصدير جديد</li>
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
                    <form action=" {{route('admin.invoices.export_invoices_store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">المنتج</label>
                        <div class="col-md-5">
                            <select id="product_id" name="product_id" class="form-select">
                            <option  value="">اختار المنتج </option>

                                @foreach($products as $product)
                                <option  value="{{ $product->id }}">{{ $product->name . '-' . $product->provider->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">المورد</label>
                        <div class="col-md-5">
                            <select name="provider_id" class="form-select">
                            <option  value="">اختار المورد </option>
                                @foreach($providers as $provider)
                                <option  value="{{ $provider->id }}">{{ $provider->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> -->
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">المستلم</label>
                        <div class="col-md-5">
                            <select id="receiver_type" name="receiver_type" class="form-select">
                            <option  value="">اختار المستلم </option>
                                <option  value="1">مندوب</option>
                                <option  value="2">شخص</option>
                                <option  value="3">جمعية</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">المناديب</label>
                        <div class="col-md-5">
                            <select id="actor_id" name="actor_id" class="form-select">
                            <option   value="">اختار المندوب </option>
                                @foreach($actors as $actor)
                                <option  value="{{ $actor->id }}">{{ $actor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">المستفيد</label>
                        <div class="col-md-5">
                            <select id="beneficiaries_id" id="beneficiaries_id" name="beneficiaries_id" class="form-select">
                            <option  value="">اختار المستفيد </option>
                                @foreach($beneficiaries as $beneficial)
                                <option  value="{{ $beneficial->id }}">{{ $beneficial->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">اسم الجمعية/المؤسسة</label>
                        <div class="col-md-5">
                            <input id="og_name" class="form-control" placeholder="اسم الجمعية/المؤسسة" type="text" value="{{old('og_name')}}" name="og_name" id="example-text-input">
                        </div>
                    </div>
                 
                    <input type="hidden" value="{{null}}" name="id">

                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">الكمية</label>
                        <div class="col-md-5">
                            <input class="form-control" placeholder="الكمية" type="number"  step="0.001" pattern="^\d*(\.\d{0,2})?$"  value="{{old('quantity')}}" name="quantity" id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">الوحدة</label>
                        <div class="col-md-5">
                            <select id="unit_id" name="unit_id" class="form-select">
                            <option  value="">اختار الوحدة </option>

                                @foreach($units as $unit)
                                <option  value="{{ $unit->id }}">{{ $unit->name }}</option>
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
<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/jquery-time-picker.js') }}"></script>
    <script>
       $(document).ready(function () {
            // document.getElementById('#actor_id').hidden = true;
            // document.getElementById('#beneficiaries_id').hidden = true;
            // document.getElementById('#og_name').hidden = true;

            // $('#receiver_type').change(function(e){
            //    console.log(e.val);
               

            // });
       });
    </script>
@endsection
