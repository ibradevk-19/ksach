<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="import">
            <input type="file" wire:model="file">

            @error('file')
                <span class="error">{{ $message }}</span>
            @enderror

            <button type="submit">Import Data</button>
        </form>

        <div wire:loading wire:target="file">
            Uploading...
        </div>

        @if($progress > 0)
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                    {{ $progress }}%
                </div>
            </div>
        @endif
    </div>

</div>
