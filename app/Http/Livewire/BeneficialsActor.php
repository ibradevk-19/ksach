<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\WordFood;
class BeneficialsActor extends Component
{
    public $full_name = null;

    // Reset the pagination when the search query (full_name) is updated
    public function updatingFullName()
    {
        $this->resetPage();
    }

    public function render()
    {

        $actor_id = \Auth::guard('actor')->user()->id;

        // Always apply 'actor_id' condition first
        $beneficials = WordFood::with('familyDetailsInfo', 'deliveryRecordBeneficials', 'deliveryRecordBeneficials.product')
            ->where('actor_id', $actor_id)
            ->when($this->full_name, function ($query) {
                $query->where(function ($query) {
                    $query->where('full_name', 'like', '%' . $this->full_name . '%')
                          ->orWhere('id_num', (int)$this->full_name);
                });
            })
            ->paginate(15);
        return view('livewire.beneficials-actor')->with([
            'beneficials' => $beneficials,
        ]);
    }
}
