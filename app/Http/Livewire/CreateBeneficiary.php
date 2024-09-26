<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Family;
use App\Models\Actor;
use Illuminate\Support\Facades\Http;

class CreateBeneficiary extends Component
{
    public $full_name, $id_num, $wife_name, $wife_id_num, $mobile, $marital_status, $family_count, $family_id, $actor_id;
    public $families = [], $actors = [];
   
    public function mount()
    {
        // Fetch families and actors from the database
        $this->families = Family::all();
        $this->actors = Actor::all();
    }

    public function checkIdNumber()
    {
 
        if ($this->id_num) {
            $response = Http::get('check_number/' . $this->id_num);
            if ($response->successful() && $response->json('full_name')) {
                $this->full_name = $response->json('full_name');
            } else {
                $this->full_name = 'لا يوجد له بيانات';
            }
        }
    }

    public function checkIdNumberWife()
    {
       
        if ($this->wife_id_num) {
            $response = Http::get('check_number/' . $this->wife_id_num);
            if ($response->successful() && $response->json('full_name')) {
                $this->wife_name = $response->json('full_name');
            } else {
                $this->wife_name = 'لا يوجد لها بيانات';
            }
        }
    }

    public function save()
    {
        $this->validate([
            'full_name' => 'required|string|max:255',
            'id_num' => 'required|string|max:10',
            'mobile' => 'required|string|max:10',
            'marital_status' => 'required',
            'family_count' => 'required|integer|min:1',
            'family_id' => 'required',
            'actor_id' => 'required',
        ]);

        // Save logic goes here, maybe Beneficiary::create([...]);

        session()->flash('message', 'تم إضافة المستفيد بنجاح');
    }

    public function render()
    {
        return view('livewire.create-beneficiary');
    }
}
