

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="del_modal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">حذف صلاحية -  {{$obj->name}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>في حال تم الحذف , سيتم الغاء تفعيل المسؤولين المتربطين في  - {{$obj->name}} </p>
                <p>لتجنب ذلك , يمكنك الغاء الحذف أو اختيار إحدى الصلاحيات الأخرى :   </p>

                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">الصلاحيات</label>
                        <div class="col-md-10">

                            <select name="status" id="role_id" class="form-select ">
                                <option  value="{{null}}">اختر</option>

                                @foreach ($roles_all as $item)

                                <option  value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>

                    <input type="hidden" value="{{$obj->id}}" id="id_value">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">الغاء</button>
                <button type="button" onclick="delItemRequest()" class="btn btn-danger waves-effect waves-light">استكمال العملية</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


