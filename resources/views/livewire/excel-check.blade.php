<div>
<div>
    <form wire:submit.prevent="checkNumbers">
        <input type="file" wire:model="excelFile">

        @error('excelFile') 
            <span class="error">{{ $message }}</span>
        @enderror

        <button type="submit">فحص الأرقام</button>
    </form>

    <div class="progress" style="margin-top: 20px;">
        <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
            {{ $progress }}%
        </div>
    </div>

    <div>
        <h4>Checked Numbers</h4>
        <ul>
            @foreach($checkedNumbers as $number)
                <li>{{ $number }}</li>
            @endforeach
        </ul>
    </div>
</div>

</div>
