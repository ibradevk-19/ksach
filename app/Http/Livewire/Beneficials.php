<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Actor;
use App\Models\WordFood;
use App\Models\Province;
use App\Models\City;
use App\Models\HousingComplex;



class Beneficials extends Component
{
    use WithPagination;

    public $exportFormat;
    public $searchProvider = null;
    public $full_name = null;
    public $id_num = null;
    public $searchProduct = null;
    public $searchActor = null; // For filtering by actor name
    public $perPage = 15;  // Default value
    public $showAll = false;  // Toggle state for "Show All"
    public $selectedBeneficials = [];  // Array to hold selected invoice IDs
    public $selectAll = false;
    public $BeneficialsDetails;  // Holds the selected invoice details for the modal
    public $province = null;
    public $housing_complexs = null;
    public $cities = null;
    public $marital_status = null;
    public $is_displaced = null;
    public $a =  3;
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedBeneficials = WordFood::pluck('id')->toArray();  // Select all invoices
        } else {
            $this->selectedBeneficials = [];  // Deselect all
        }
    }

    public function toggleShowAll()
    {

        $this->showAll = !$this->showAll;

        if ($this->showAll) {
            $this->perPage = null;  // Show all records
        } else {
            $this->perPage = 15;  // Reset to paginated view
        }
    }

    public function showAll()
    {

        $this->perPage = null;  // This will show all items
    }

    public function render()
    {

        $query = WordFood::with('actor','familyDetailsInfo','familyDetailsInfo.province_name','familyDetailsInfo.city_name','familyDetailsInfo.housing_complex_name','deliveryRecordBeneficials','deliveryRecordBeneficials.product')
            ->when($this->province, function ($query) {
                $query->whereHas('familyDetailsInfo.province_name', function ($q) {
                    $q->where('id', $this->province);
                });
            })->when($this->housing_complexs, function ($query) {
                $query->whereHas('familyDetailsInfo.housing_complex_name', function ($q) {
                    $q->where('id', $this->housing_complexs);
                });
            })->when($this->marital_status, function ($query) {
                $query->whereHas('familyDetailsInfo', function ($q) {
                    $q->where('marital_status', $this->marital_status);
                });
            })->when($this->is_displaced, function ($query) {

                if((int) $this->is_displaced != 1){
                    $this->a  = 0;
                }else{
                    $this->a = 1;
                }
                $query->whereHas('familyDetailsInfo', function ($q) {
                    $q->where('is_displaced','==', $this->a);
                });
            })->when($this->searchActor, function ($query) {
                $query->whereHas('actor', function ($q) {
                    $q->where('name', 'like', '%'.$this->searchActor.'%');
                });
            })->when($this->full_name, function ($query) {
                $query->where('full_name', 'like', '%'.$this->full_name.'%');
            })
            ->when($this->id_num, function ($query) {
                $query->where('id_num',$this->id_num)->orWhere('wife_id_num',$this->id_num);
            });

            if($this->showAll){
                $beneficials = $query->get();
            }else{
                $beneficials = $query->paginate($this->perPage);
            }
            $provinces = Province::all();

            return view('livewire.beneficials')->with([
            'beneficials' => $beneficials,
            'actors' => Actor::all(),
            'provinces' => $provinces,
            'cities_list' => City::where('province_id',$this->province)->get(),
            'housing_complexss_list' => HousingComplex::where('city_id',$this->cities)->get(),
        ]);
    }
}
