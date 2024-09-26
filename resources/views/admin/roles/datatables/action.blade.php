<div class="button-items">
    <a href="{{ route('roles.edit', ['role' => $id]) }}"
       class=" btn btn-primary waves-effect waves-light btn-sm">
        <i class=" ri-eye-line align-middle me-2"></i>
        عرض
    </a>
    <a href="javascript:void(0)" onclick="show_del_modal('{{$id}}')" class=" btn btn-danger waves-effect waves-light btn-sm " data-target="#delete_modal" data-toggle="modal">
        <i class=" ri-delete-bin-line align-middle me-2"></i>
        حذف
    </a>
</div>
