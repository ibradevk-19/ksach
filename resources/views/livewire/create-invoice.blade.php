<div>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">فاتورة جديدة</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active">فاتورة جديدة</li>
                    </ol>
                </div>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="submit">
                    <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">نوع الفاتورة</label>
                            <div class="col-md-5">
                                <select wire:model="type" class="form-select">
                                    <option value="">اختار النوع</option>
                                    <option value="out">صادر </option>
                                    <option value="in">  وارد </option>
                                    <option value="damaged">  تالف </option>
                                </select>
                                @error('port_name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @if ($type !== 'out')
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">المورد</label>
                            <div class="col-md-5">
                                <select wire:model="provider_id" class="form-select">
                                    <option value="">اختار المورد</option>
                                    @foreach($providers as $provider)
                                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                    @endforeach
                                </select>
                                @error('provider_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">التصنيف</label>
                            <div class="col-md-5">
                                <select wire:model="category_id" class="form-select">
                                    <option value="">اختار التصنيف</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">المنفذ</label>
                            <div class="col-md-5">
                                <select wire:model="port_name" class="form-select">
                                    <option value="">اختار المنفذ</option>
                                    <option value="1">معبر رفح</option>
                                    <option value="2">معبر كرم أبو سالم</option>
                                    <option value="3">معبر إيرز</option>
                                </select>
                                @error('port_name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @endif
                        @if ($type == 'out')
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">المستلم</label>
                            <div class="col-md-5">
                                <select wire:model="receiver_type" id="receiver_type" name="receiver_type" class="form-select">
                                <option  value="">اختار المستلم </option>
                                    <option  value="1">مندوب</option>
                                    <option  value="2">شخص</option>
                                    <option  value="3">جمعية</option>
                                </select>
                            </div>
                        </div>
                            @if ($receiver_type == '1')
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">المناديب</label>
                                <div class="col-md-5">
                                    <select wire:model="receiver_id" id="actor_id" name="actor_id" class="form-select">
                                    <option   value="">اختار المندوب </option>
                                        @foreach($actors as $actor)
                                        <option  value="{{ $actor->id }}">{{ $actor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            @if ($receiver_type == '2')
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">المستفيد</label>
                                <div class="col-md-5">
                                    <select wire:model="receiver_id" id="beneficiaries_id" id="beneficiaries_id" name="beneficiaries_id" class="form-select">
                                    <option  value="">اختار المستفيد </option>
                                        @foreach($beneficiaries as $beneficial)
                                        <option  value="{{ $beneficial->id }}">{{ $beneficial->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            @if ($receiver_type == '3')
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">اسم الجمعية/المؤسسة</label>
                                <div class="col-md-5">
                                    <input wire:model="og_name" id="og_name" class="form-control" placeholder="اسم الجمعية/المؤسسة" type="text" value="{{old('og_name')}}" name="og_name" id="example-text-input">
                                </div>
                            </div>
                            @endif
                        @endif
                        @foreach($invoiceItems as $index => $item)
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">المنتج</label>
                                <div class="col-md-4">
                                    <select wire:model="invoiceItems.{{ $index }}.product_id" class="form-select">
                                        <option value="">اختار المنتج</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('invoiceItems.' . $index . '.product_id') 
                                        <span class="error">{{ $message }}</span> 
                                    @enderror
                                </div>

                                <label class="col-md-2 col-form-label">التصنيف</label>
                                <div class="col-md-4">
                                    <select wire:model="invoiceItems.{{ $index }}.category_id" class="form-select">
                                        <option value="">اختار التصنيف</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('invoiceItems.' . $index . '.category_id') 
                                        <span class="error">{{ $message }}</span> 
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="quantity" class="col-md-2 col-form-label">الكمية</label>
                                <div class="col-md-3">
                                    <input wire:model="invoiceItems.{{ $index }}.quantity" class="form-control" type="number" min="1">
                                    @error('invoiceItems.' . $index . '.quantity') 
                                        <span class="error">{{ $message }}</span> 
                                    @enderror
                                </div>

                                <label class="col-md-2 col-form-label">الوحدة</label>
                                <div class="col-md-3">
                                    <select wire:model="invoiceItems.{{ $index }}.unit_id" class="form-select">
                                        <option value="">اختار الوحدة</option>
                                        @foreach($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('invoiceItems.' . $index . '.unit_id') 
                                        <span class="error">{{ $message }}</span> 
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger" wire:click="removeItem({{ $index }})">حذف</button>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-12 mb-3">
                            <button type="button" class="btn btn-secondary" wire:click="addItem">إضافة منتج آخر</button>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">إضافة الفاتورة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
