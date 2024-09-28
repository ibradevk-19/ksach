<div>
    <form wire:submit.prevent="submit">
        @csrf
        @include('beneficial.form-steps.main')
      <div class="col-12">
        @if ($currentStep == 1)
        <div></div>
        @endif

        @if ($currentStep == 2 || $currentStep == 3)
            <button type="button" class="btn btn-md btn-secondary" wire:click="decreaseStep()">السابق</button>
        @endif

        @if ($currentStep == 1 || $currentStep == 2 || $currentStep == 3)
            <button type="button" class="btn btn-md btn-success" wire:click="increaseStep()">التالي</button>
        @endif

       @if ($currentStep == 3)
           <button type="submit"  class="btn btn-primary disabled_button_click">إضافة</button>
        @endif
      </div>
  </form>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        function initSelect2() {
            $('#actor_id').select2();

            // Ensure Livewire property is updated when Select2 changes

            $('#family_id').select2();

            // Ensure Livewire property is updated when Select2 changes

        }

        // Initialize Select2 when Livewire is loaded
        initSelect2();

        // Reinitialize Select2 after Livewire updates the DOM
        Livewire.hook('message.processed', (message, component) => {
            initSelect2(); // Reinitialize Select2 after each DOM update
        });
    });
</script>
