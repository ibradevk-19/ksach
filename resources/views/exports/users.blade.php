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
        <th align="center">نوع المساعدة</th>
        <th align="center">المندوب </th>
        <th align="center">الحالة </th>


    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="center">{{ $item->beneficial->full_name }}</td>
            <td align="center">{{ $item->beneficial->id_num }}</td>
            <td align="center">{{ $item->beneficial->wife_name }}</td>
            <td align="center">{{ $item->beneficial->wife_id_num }}</td>
            <td align="center">{{ $item->beneficial->mobile }}</td>
            <td align="center">{{ $item->product->name }}</td>
            <td align="center">{{ $item->beneficial->actor->name }}</td>
            <td align="center">
                @if($item->status == 2)
                   تم الاستلام
                @else
                  لم يستلم
                @endif
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
