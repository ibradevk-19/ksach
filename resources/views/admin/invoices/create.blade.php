@extends('includes.main')
@section('content')


<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">فاتورة جديده</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"> الرئيسية</a></li>
                        <li class="breadcrumb-item active">فاتورة جديد</li>
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
                    <form action=" {{route('invoices.store')}}" method="post" enctype="multipart/form-data">
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
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">المورد</label>
                        <div class="col-md-5">
                            <select id="provider_id" name="provider_id" class="form-select">
                            <option  value="">اختار المورد </option>

                                @foreach($providers as $provider)
                                <option  value="{{ $provider->id }}">{{ $provider->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">التصنيف</label>
                        <div class="col-md-5">
                            <select name="category_id" class="form-select">
                            <option  value="">اختار التصنيف </option>

                                @foreach($categories as $category)
                                <option  value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">المنفذ</label>
                        <div class="col-md-5">
                            <select name="port_name" class="form-select">
                                <option  value="">اختار المنفذ </option>
                                <option  value="1">معبر رفح</option>
                                <option  value="2">معبر كرم ابوسالم</option>
                                <option  value="3">معبر ايرز </option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" value="{{null}}" name="id">

                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">الكمية</label>
                        <div class="col-md-5">
                            <input class="form-control" placeholder="الكمية" type="number" min="1" value="{{old('quantity')}}" name="quantity" id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">الوحدة</label>
                        <div class="col-md-5">
                            <select id="unit_id" name="unit_id" class="form-select">
                            <option   value="">اختار الوحدة </option>

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
    function showImage(id_input,id_show_image = 'show_image'){

document.getElementById(id_show_image+'_show').hidden = false;

const imagefile = document.querySelector('#'+id_input);

console.log( imagefile.files[0]);
var reader = new FileReader();
reader.onload = function(e) {
$('#'+id_show_image).attr('src', e.target.result);
};

reader.readAsDataURL(imagefile.files[0]);
}
</script>
@endsection
