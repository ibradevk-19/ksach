<div>
    <div>
        <!-- Filter Section -->

        <div class="row">
            <div class="col-lg-12">
               <div class="card">
                <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <label for="full_name" class="form-label">اسم المعيل رباعي </label>
                        <input type="text" wire:model="full_name"  class="form-control"  id="full_name" name="full_name" >
                    </div>
            <!-- Provider Filter -->
            <div class="col-md-3">

                    <label for="full_name" class="form-label">رقم الهوية</label>
                    <input type="text" wire:model="id_num"  class="form-control"  id="id_num" name="id_num" >

            </div>

            <!-- Product Filter -->
            <div class="col-md-3">
                <label for="province" class="form-label"> المحافظة </label>
                <select class="form-select" id="province" wire:model="province" name="province" >
                    <option value=""  selected>اختر  </option>
                    @foreach($provinces as $province)
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="housing_complexs" class="form-label"> التجمع السكاني </label>
                <select class="form-select" id="housing_complexs" wire:model="housing_complexs" name="housing_complexs" >
                    <option value=""  selected>اختر  </option>
                    @foreach($housing_complexss as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="searchPort" class="form-label">اسم المنفذ</label>
                <select id="searchPort" wire:model="searchPort" class="form-control">
                    <option value="">كل المنافذ</option>
                    <option value="1">معبر رفح</option>
                    <option value="2">معبر كرم ابوسالم</option>
                    <option value="3">معبر ايرز</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="searchActor" class="form-label">المندوب</label>
                <select id="searchActor" wire:model="searchActor" class="form-control">
                    <option value="">اختار</option>
                    @foreach($actors as $actor)
                        <option value="{{ $actor->name }}">{{ $actor->name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-3">
                <label for="searchOgName" class="form-label">اسم المنظمة</label>
                <input type="text" id="searchOgName" wire:model="searchOgName" class="form-control" placeholder="ابحث عن اسم المنظمة">
            </div>


        </div>
        <div class="mb-4">

               <a href="{{route('invoices.create')}}"  class="btn btn-primary">فاتورة جديدة </a>


            <button wire:click="toggleShowAll" class="btn btn-primary">
                {{ $showAll ? 'Show Paginated' : 'Show All' }}
            </button>
            <button wire:click="exportSelected" class="btn btn-success" {{ empty($selectedInvoices) ? 'disabled' : '' }}>
                Export Selected (PDF)
            </button>
            <button wire:click="exportSelectedExcel" class="btn btn-success" {{ empty($selectedInvoices) ? 'disabled' : '' }}>
                Export Selected (Excel)
            </button>
            <!-- <button wire:click="exportSelected" class="btn btn-success" {{ empty($selectedRecords) ? 'disabled' : '' }}>
                Export Selected (PDF)
            </button>
            <button wire:click="exportSelectedExcel" class="btn btn-success" {{ empty($selectedRecords) ? 'disabled' : '' }}>
                Export Selected (Excel)
            </button>
            <button wire:click="deleteSelected" class="btn btn-danger" {{ empty($selectedRecords) ? 'disabled' : '' }}>
                Delete Selected
            </button>
            <button wire:click="AprovelSelected" class="btn btn-danger" {{ empty($selectedRecords) ? 'disabled' : '' }}>
                Approval All Selected
            </button>
            <button wire:click="DisAprovelSelected" class="btn btn-danger" {{ empty($selectedRecords) ? 'disabled' : '' }}>
                DisApproval All Selected
            </button> -->

        </div>
                </div>
               </div>
            </div>
        </div>

        <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">المستفيدين</h4>
                    <p class="card-title-desc"></p>

                    <!-- Add table-responsive class for responsiveness -->
                    <div class="table-responsive">
                        <table class="table mb-0 table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> <input type="checkbox" wire:model="selectAll"></th>

                                    <th><b>#</b></th>
                                    <th>اسم المعيل</th>
                                    <th>رقم الهوية</th>
                                    <th>المحافظة</th>
                                    <th>المدينة</th>
                                    <th>التجمع السكني</th>
                                    <th>رقم الجوال</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($beneficials as $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" wire:model="selectedBeneficials" value="{{ $item->id }}">
                                        </td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->full_name }}</td>
                                        <td>{{ $item->id_num }}</td>
                                        <td>{{ $item->familyDetailsInfo?->province_name?->name }}</td>
                                        <td>{{ $item->familyDetailsInfo?->city_name?->name }}</td>
                                        <td>{{ $item->familyDetailsInfo?->housing_complex_name?->name }}</td>
                                        <td>{{ $item->mobile }}</td>

                                        {{-- <td>
                                            <!-- View Button to open the modal -->
                                            <button class="btn btn-primary" wire:click="viewInvoice({{ $invoice->id }})">View</button>
                                            <button class="btn btn-primary" wire:click="InvoicePdf({{ $invoice->id }})">PDF</button>

                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">لا يوجد </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                        @if(!$showAll)
                            <div>
                            {{ $beneficials->links('vendor.livewire.custom-pagination') }}
                            </div>
                        @endif
                </div>

                {{-- <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document"> <!-- 'modal-lg' for a larger modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invoiceModalLabel">تفاصيل الفاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($invoiceDetails)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>رقم الفاتورة</th>
                                    <th>المورد</th>
                                    <th>المستلم</th>
                                    <th>التاريخ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $invoiceDetails->id }}</td>
                                    <td>{{ $invoiceDetails->provider->name }}</td>
                                    <td>{{ $invoiceDetails->receiver_name }}</td>
                                    <td>{{ $invoiceDetails->date }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <h5>تفاصيل الفاتورة</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>البند</th>
                                    <th>الكمية</th>
                                    <th>الوحدة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoiceDetails->items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->unit->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p>No invoice details available.</p>
                    @endif
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div> --}}

    </div>

    <script>
        // window.addEventListener('show-invoice-modal', event => {
        //     $('#invoiceModal').modal('show');
        // });
        // window.addEventListener('show-invoice-modal', event => {
        // $('#invoiceModal').modal('show');
        // });

        // window.addEventListener('hide-invoice-modal', event => {
        //     $('#invoiceModal').modal('hide');
        // });
    </script>

    </div>

</div>
