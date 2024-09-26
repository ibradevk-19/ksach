                @if($status=='1')
                <span class="btn btn-warning ms-1">لم يستلم </span>
                @elseif($status=='2')
                <span class="btn btn-success ms-1">تم التسليم </span>
                @else
                <span class="btn btn-danger ms-1">متوقف</span>
                @endif

