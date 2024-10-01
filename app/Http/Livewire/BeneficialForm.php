<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Family;
use App\Models\Actor;
use App\Models\Sokan;
use App\Models\Civilrecord;

class BeneficialForm extends Component
{
    //main data
    public $full_name;
    public $id_num;
    public $wife_name;
    public $wife_id_num;
    public $family_count;
    public $marital_status;
    public $mobile;
    public $family_id;
    public $actor_id;

    public $families = [], $actors = [];
    public $totalSteps = 3;
    public $currentStep = 1;
    public function mount()
    {
        $this->currentStep = 1;
        // Fetch families and actors from the database
        $this->families = Family::all();
        $this->actors = Actor::all();
    }

    public function increaseStep(){
         $this->currentStep++;
         if($this->currentStep > $this->totalSteps){
             $this->currentStep = $this->totalSteps;
         }
    }

    public function decreaseStep(){
        $this->currentStep--;
        if($this->currentStep < 1){
            $this->currentStep = 1;
        }
    }

    public function fullName() {
        $user = Sokan::where('id_number',$this->id_num)->first();
        $this->full_name = $user->full_name ?? '';
    }

    public function WfullName() {
        $user = Sokan::where('id_number',$this->wife_id_num)->first();
        $this->wife_name = $user->full_name ?? '';
    }



    public function render()
    {
        return view('livewire.beneficial-form');
    }


    public function submit(){

        dd($this->full_name,$this->family_id);

    }

}
