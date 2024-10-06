<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="import">
            <div class="mb-3 row">
            <div class="col-md-3">
                <select wire:model="actor_id" class="form-select">
                    <option value="">اختار المندوب</option>
                    @foreach($actors as $actor)
                        <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                    @endforeach
                </select>
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col-md-3">
                <input type="file" wire:model="file">
            </div>

            @error('file')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
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
