
<div>

    @if ($currentStep == 1)
       @include('beneficial.form-steps.first-step')
    @endif
    @if ($currentStep == 2)
       @include('beneficial.form-steps.step-two')
    @endif
    @if ($currentStep == 3)
       @include('beneficial.form-steps.step-three')
    @endif


</div>
