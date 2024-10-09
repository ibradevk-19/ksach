<div class="button-items">
    <a href="{{ route('delivry.index-record', ['delivry_id' => $id]) }}"
       class=" btn btn-primary waves-effect waves-light btn-sm">
        <i class=" ri-eye-line align-middle me-2"></i>
        كشف المستفيدين
    </a>
    <a href="{{ route('delivry.approvalAll', ['delivery_record_id' => $id]) }}"
       class=" btn btn-primary waves-effect waves-light btn-sm">
        <i class=" ri-eye-line align-middle me-2"></i>
        تسليم الكل
    </a>
    <a href="{{ route('delivry.print', ['delivry_id' => $id]) }}"
       class=" btn btn-primary waves-effect waves-light btn-sm">
        <i class=" ri-eye-line align-middle me-2"></i>
        طباعة كشف
    </a>
    <a href="{{ route('delivry.print-actor', ['delivry_id' => $id]) }}"
       class=" btn btn-primary waves-effect waves-light btn-sm">
        <i class=" ri-eye-line align-middle me-2"></i>
        طباعة كشف مندوب
    </a>
    {{-- <a href="{{ route('delivry.delivry-record-import', ['delivry_id' => $id]) }}"
       class=" btn btn-primary waves-effect waves-light btn-sm">
        <i class=" ri-eye-line align-middle me-2"></i>
        استيراد
    </a> --}}

    <!-- <a href="javascript:void(0)" class=" btn btn-danger waves-effect waves-light btn-sm " onclick="DeleteItem('{{$id}}')">
        <i class=" ri-delete-bin-line align-middle me-2"></i>
        حذف
    </a> -->

    <a href="{{ route('delivry.print', ['delivry_id' => $id]) }}"
        class=" btn btn-primary waves-effect waves-light btn-sm">
         <i class=" ri-eye-line align-middle me-2"></i>
           تفعيل
     </a>
</div>
