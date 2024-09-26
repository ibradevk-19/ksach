<table class="table">
    <thead>
    <tr>
        <th align="center"></th>
        <th align="center"  colspan="3"><b>كشف </b></th>
        <th align="center" colspan="4"><b>{{__('بتاريخ :')." ".date('Y/m/d h:i A', strtotime('+3 hours'))}}</b></th>
    </tr>
    <tr>
        <th align="center">#</th>
        <th align="center">الاسم</th>
        <th align="center">رقم الهوية</th>
        <th align="center">اسم الزوجة</th>
        <th align="center">رقم هوية الزوجة</th>
        <th align="center">رقم الجوال</th>
        <th align="center">عدد الافراد</th>
        <th align="center">السبب</th>
        <th align="center">السبب</th>
        <th align="center">السبب الزوج</th>
        <th align="center">السبب الزوجة</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="center">{{ $item->full_name }}</td>
            <td align="center">{{ $item->id_num }}</td>
            <td align="center">{{ $item->wife_name }}</td>
            <td align="center">{{ $item->wife_id_num }}</td>
            <td align="center">{{ $item->mobile }}</td>
            <td align="center">{{ $item->family_count }}</td>
            <td align="center">{{ $item->reson?? '' }}</td>
            <td align="center">{{ $item->reson_one?? '' }}</td>
            <td align="center">{{ $item->reson_tow?? '' }}</td>
            <td align="center">{{ $item->reson_th?? '' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
