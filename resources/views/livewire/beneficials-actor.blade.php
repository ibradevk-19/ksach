<div>
    <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">كشف المستفيدين</h3>
            <div class="d-flex ms-auto">
                <input wire:model="full_name" type="text" class="form-control me-2" placeholder="ابحث...">
                <button type="button" class="btn btn-primary">اضافة مستفيد</button>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
              <thead>
                <tr>
                    <th><b>#</b></th>
                    <th>اسم المعيل</th>
                    <th>رقم الهوية</th>
                    <th>اسم الزوجة</th>
                    <th>رقم هوية الزوجة</th>
                    <th>رقم الجوال</th>
                    <th>عدد الافراد</th>
                    <th> الحالة</th>
                </tr>
              </thead>
              <tbody>

                @forelse ($beneficials as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->full_name }}</td>
                    <td>{{ $item->id_num }}</td>
                    <td>{{ $item->wife_name }}</td>
                    <td>{{ $item->wife_id_num }}</td>
                    <td>{{ $item->mobile }}</td>
                    <td>{{ $item->family_count }}</td>
                    <td>
                        @if($item->is_approved == 1)
                            <span class="badge rounded-pill bg-success">معتمد</span>
                        @elseif($item->is_approved == 2)
                            <span class="badge rounded-pill bg-danger">قيد الانتظار</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">لم يتم العثور على سجلات </td>
                </tr>
            @endforelse

              </tbody>
            </table>
          </div>
          <div>
            {{ $beneficials->links() }}
            </div>
        </div>
      </div>
    </div>
