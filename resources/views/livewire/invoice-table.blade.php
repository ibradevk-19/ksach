<div>
    <!-- Filter Section -->
 
    <div class="row">
        <div class="col-lg-12">
           <div class="card">
            <div class="card-body">
            <div class="row mb-4">
        <div class="col-md-3">
                <label for="searchType" class="form-label">النوع </label>
                <select id="searchType" wire:model="searchType" class="form-control">
                    <option value="">الكل </option>
                    <option value="out">صادر</option>
                    <option value="in">وارد  </option>
                    <option value="damaged">تالف  </option>
                </select>
         </div>
        <!-- Provider Filter -->
        <div class="col-md-3">
            <label>المورد</label>
            <select id="searchProvider" wire:model="searchProvider" class="form-control">
                <option value="">كل الموردين</option>
                @foreach($providers as $provider)
                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Product Filter -->
        <div class="col-md-3">
            <label>المنتج</label>
            <select id="searchProduct" wire:model="searchProduct" class="form-control">
                <option value="">كل المنتجات</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="searchDate" class="form-label">تاريخ الفاتورة</label>
            <input type="date" id="searchDate" wire:model="searchDate" class="form-control">
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
                <h4 class="card-title">الفاتورة</h4>
                <p class="card-title-desc"></p>

                <!-- Add table-responsive class for responsiveness -->
                <div class="table-responsive">
                    <table class="table mb-0 table-bordered table-hover">
                        <thead>
                            <tr>
                                <th> <input type="checkbox" wire:model="selectAll"></th>
                               
                                <th><b>#</b></th>
                                <th>المورد</th>
                                <th>المستلم</th>
                                <th>النوع</th>
                                <th>التاريخ</th>
                                <th>المنفذ</th>
                                <th>****</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($invoices as $invoice)
                                <tr>
                                    <td>
                                        <input type="checkbox" wire:model="selectedInvoices" value="{{ $invoice->id }}">
                                    </td>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->provider->name }}</td>
                                    <td>{{ $invoice->receiver_name }}</td>
                                    <td>
                                        @if($invoice->type == 'وارد')
                                            <span class="badge rounded-pill bg-success">وارد</span>
                                        @elseif($invoice->type == 'تالف')
                                            <span class="badge rounded-pill bg-danger">تالف</span>
                                        @endif
                                    </td>
                                    <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $invoice->port_name }}</td>
                                    <td>
                                        <!-- View Button to open the modal -->
                                        <button class="btn btn-primary" wire:click="viewInvoice({{ $invoice->id }})">View</button>
                                        <button class="btn btn-primary" wire:click="InvoicePdf({{ $invoice->id }})">PDF</button>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">لا يوجد فواتير</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                    @if(!$showAll)
                        <div>
                        {{ $invoices->links('vendor.livewire.custom-pagination') }}
                        </div>
                    @endif
            </div>

            <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
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
</div>

</div>

<script>
    window.addEventListener('show-invoice-modal', event => {
        $('#invoiceModal').modal('show');
    });
    window.addEventListener('show-invoice-modal', event => {
    $('#invoiceModal').modal('show');
    });

    window.addEventListener('hide-invoice-modal', event => {
        $('#invoiceModal').modal('hide');
    });
</script>
    
</div>
