<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\WordFood;
class BeneficialsActor extends Component
{
    public $full_name = null;

    public function render()
    {

        $actor_id = \Auth::guard('actor')->user()->id;
        $beneficials = WordFood::with('familyDetailsInfo','deliveryRecordBeneficials','deliveryRecordBeneficials.product')
                                ->where('actor_id',$actor_id)
                                ->when($this->full_name, function ($query) {
                                    $query->where('full_name', 'like', '%'.$this->full_name.'%')->Orwhere('id_num', (int)$this->full_name);
                                })
                                ->paginate(15);
        return view('livewire.beneficials-actor')->with([
            'beneficials' => $beneficials,
        ]);
    }
}
