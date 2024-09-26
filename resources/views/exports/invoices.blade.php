<table class="table">
    <thead>
    <tr>
        <th align="center"></th>
        <th align="center"  colspan="3"><b>كشف </b></th>
        <th align="center" colspan="4"><b>{{__('بتاريخ :')." ".date('Y/m/d h:i A', strtotime('+3 hours'))}}</b></th>
    </tr>
    <tr>
            <th align="center"><b>#</b></th>
            <th align="center">التاريخ</th>
            <th align="center">الحركة</th>
            <th align="center">المستلم </th>
            <th align="center">المورد </th>
            <th align="center">المنفذ </th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="center">{{ $item['date'] }}</td>
            <td align="center">{{ $item['type']}}</td>
            <td align="center">{{ $item['receiver_name'] }}</td>
            <td align="center">{{ $item->provider->name }}</td>
            <td align="center">{{ $item['port_name'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
