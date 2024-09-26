<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                     <div class="mb-3 row">
                        <div class="col-md-4">
                            <input class="form-control" placeholder="اسم الزوج" type="text" wire:model.debounce.300ms="searchFullName"  id="example-text-input">
                        </div>
                        <div class="col-md-4">
                            <input class="form-control" placeholder="رقم الهوية" type="text" wire:model.debounce.300ms="searchIdNum"  id="searchIdNum">
                        </div>
                        <div class="col-md-4">
                            <input class="form-control" placeholder="اسم الزوجة" type="text" wire:model.debounce.300ms="searchWifeName"  id="searchWifeName">
                        </div>
                       
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <input class="form-control" placeholder="رقم هوية الزوجة" type="text" wire:model.debounce.300ms="searchWifeIdNum"  id="searchWifeName">
                        </div>
                        <div class="col-md-4">
                            <input class="form-control" placeholder="رقم الجوال " type="text" wire:model.debounce.300ms="searchMobile"  id="searchWifeName">
                        </div>

                        <div class="col-md-4">
                            <input class="form-control" placeholder="المندوب" type="text" wire:model.debounce.300ms="searchActorName"  id="searchActorName">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-4">
        <button wire:click="toggleShowAll" class="btn btn-primary">
            {{ $showAll ? 'ترقيم الصفحات' : 'عرض الكل' }}
        </button>
        <button wire:click="exportSelected" class="btn btn-success" {{ empty($selectedRecords) ? 'disabled' : '' }}>
            استخراج  (PDF)
        </button>
        <button wire:click="exportSelectedExcel" class="btn btn-success" {{ empty($selectedRecords) ? 'disabled' : '' }}>
            استخراج (Excel)
        </button>
        <button wire:click="deleteSelected" class="btn btn-danger" {{ empty($selectedRecords) ? 'disabled' : '' }}>
            حذف المحدد
        </button>
        <button wire:click="AprovelSelected" class="btn btn-danger" {{ empty($selectedRecords) ? 'disabled' : '' }}>
            تسليم
        </button>
        <button wire:click="DisAprovelSelected" class="btn btn-danger" {{ empty($selectedRecords) ? 'disabled' : '' }}>
           الغاء التسليم
        </button>
        
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">كشف الدورة</h4>
                    <p class="card-title-desc">
                      
                    </p>

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" wire:model="selectAll"></th>
                                    <th><b>#</b></th>
                                    <th>اسم الزوج</th>
                                    <th >رقم الهوية</th>
                                    <th>اسم الزوجة </th>
                                    <th>رقم الهوية </th>
                                    <th>نوع المساعدة </th>
                                    <th>المندوب</th>
                                    <th>الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($deliveryRecords as $record)
                                <tr>
                                <td><input type="checkbox" wire:model="selectedRecords" value="{{ $record->id }}"></td>
                                <td>{{ $record->beneficial->id }}</td>
                                <td>{{ $record->beneficial->full_name }}</td>
                                <td>{{ $record->beneficial->id_num }}</td>
                                <td>{{ $record->beneficial->wife_name }}</td>
                                <td>{{ $record->beneficial->wife_id_num }}</td>
                                <td>{{ $record->product->name }}</td>
                                <td>{{ $record->beneficial?->actor?->name }}</td>
                                <td>
                                    @if($record->status=='2')
                                        <span class="badge rounded-pill bg-success">تم التسليم</span>
                                        @else

                                        <span class="badge rounded-pill bg-danger">لم يستلم</span>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if(!$showAll)
                       {{ $deliveryRecords->links('vendor.livewire.custom-pagination') }}
                    @endif
                </div>
            
            </div>
          
        </div>
    </div>
  
 
</div>
