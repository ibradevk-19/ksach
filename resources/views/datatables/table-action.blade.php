@if (checkPermission($editPermission))
<div class="button-items">
    <a href="{{ $route }}"
       class=" btn btn-primary waves-effect waves-light btn-sm">
        <i class=" ri-eye-line align-middle me-2"></i>
        عرض
    </a>
    <a href="javascript:void(0)" class=" btn btn-danger waves-effect waves-light btn-sm " onclick="DeleteItem('{{$deleteId}}')">
        <i class=" ri-delete-bin-line align-middle me-2"></i>
        حذف
    </a>
</div>
@else
    <span>معطلة</span>
@endif
