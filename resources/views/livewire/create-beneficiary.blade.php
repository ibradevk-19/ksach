<div>
<div class="container-fluid">
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        <div class="mb-3 row">
                            <label for="full_name" class="col-md-2 col-form-label">الإسم</label>
                            <div class="col-md-5">
                                <input class="form-control" placeholder="الإسم" type="text" wire:model="full_name" id="full_name">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="id_num" class="col-md-2 col-form-label">رقم الهوية</label>
                            <div class="col-md-5">
                                <input class="form-control" placeholder="رقم الهوية" type="text" wire:model="id_num" id="id_num">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light btn-sm" wire:click="checkIdNumber">
                                    <i class="ri-eye-line align-middle me-2"></i> فحص
                                </button>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="wife_name" class="col-md-2 col-form-label">اسم الزوجة</label>
                            <div class="col-md-5">
                                <input class="form-control" placeholder="اسم الزوجة" type="text" wire:model="wife_name" id="wife_name">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="wife_id_num" class="col-md-2 col-form-label">رقم الهوية الزوجة</label>
                            <div class="col-md-5">
                                <input class="form-control" placeholder="رقم الهوية الزوجة" type="text" wire:model="wife_id_num" id="wife_id_num">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light btn-sm" wire:click="checkIdNumberWife">
                                    <i class="ri-eye-line align-middle me-2"></i> فحص
                                </button>
                            </div>
                        </div>

                        <!-- Repeat similar structure for mobile, marital status, family count, etc. -->

                        <div class="mb-3 row">
                            <label for="family_id" class="col-md-2 col-form-label">العائلة</label>
                            <div class="col-md-5">
                                <select class="form-select" wire:model="family_id">
                                    <option value="">اختار العائلة</option>
                                    @foreach($families as $family)
                                        <option value="{{ $family->id }}">{{ $family->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="actor_id" class="col-md-2 col-form-label">المندوب</label>
                            <div class="col-md-5">
                                <select class="form-select" wire:model="actor_id">
                                    <option value="">اختار المندوب</option>
                                    @foreach($actors as $actor)
                                        <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">إضافة</button>
                        </div>
                    </form>

                    @if (session()->has('message'))
                        <div class="alert alert-success mt-2">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

</div>
