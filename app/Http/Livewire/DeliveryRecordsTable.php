<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DeliveryRecordBeneficial;
use App\Models\WordFood;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Barryvdh\Snappy\Facades\SnappyPdf;

class DeliveryRecordsTable extends Component
{
    use WithPagination;

    public $delivry_id;

  
    public $searchFullName = '';
    public $searchIdNum = '';
    public $searchWifeName = '';
    public $searchWifeIdNum = '';
    public $searchMobile = '';
    public $searchActorName = '';
    public $statusFilter = '';
    public $selectedRecords = [];
    public $showAll = false;
    public $selectAll = false;


    public function mount($delivry_id)
    {
        $this->delivry_id = $delivry_id;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            // Select all records, not just the ones on the current page
            $this->selectedRecords = DeliveryRecordBeneficial::where('delivery_record_id',$this->delivry_id)->pluck('id')->toArray();
        } else {
            // Unselect all records
            $this->selectedRecords = [];
        }
    }

    public function updatingSearchFullName()
    {
     
        $this->resetPage();
    }
    
    public function updatingSearchProduct()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function toggleShowAll()
    {
        $this->showAll = !$this->showAll;
        $this->selectedRecords = $this->showAll 
            ? DeliveryRecordBeneficial::where('delivery_record_id',$this->delivry_id)->pluck('id')->toArray() 
            : [];
    }

    public function exportSelected()
    {
       
        if (empty($this->selectedRecords)) {
            return session()->flash('error', 'No records selected.');
        }
    
        // Fetch the data for the selected records, including related models
        $data = DeliveryRecordBeneficial::where('delivery_record_id',$this->delivry_id)->whereIn('id', $this->selectedRecords)
            ->with(['beneficial',  'beneficial.actor', 'product', 'product.provider'])
            ->get();
    
        // Generate PDF using SnappyPDF
            $pdf = SnappyPdf::loadView('delivry_pdf', [
                'data' => $data,
            ])
            ->setPaper('a4')
            ->setOption('margin-top', 10)
            ->setOption('margin-left', 10)
            ->setOption('margin-right', 10)
            ->setOption('margin-bottom', 10);

        // Return the generated PDF for download
        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->output();
        }, 'delivery-record.pdf');
    }

    public function exportSelectedExcel()
    {
       
        if (empty($this->selectedRecords)) {
            return session()->flash('error', 'No records selected.');
        }
    
        // Fetch the data for the selected records, including related models
        $data = DeliveryRecordBeneficial::where('delivery_record_id',$this->delivry_id)->whereIn('id', $this->selectedRecords)
            ->with(['beneficial',  'beneficial.actor', 'product', 'product.provider'])
            ->get();
    
        // Generate PDF using SnappyPDF
            
            return Excel::download(new UsersExport($data), 'all.xlsx');
        // Return the generated PDF for download
        // return response()->streamDownload(function() use ($pdf) {
        //     echo $pdf->output();
        // }, 'delivery-record.pdf');
    }
    public function deleteSelected()
    {
        DeliveryRecordBeneficial::where('delivery_record_id',$this->delivry_id)->whereIn('id', $this->selectedRecords)->delete();
        $this->reset('selectedRecords');
        session()->flash('message', 'Selected records have been deleted.');
    }

    public function AprovelSelected()
    {
        $data = DeliveryRecordBeneficial::where('delivery_record_id',$this->delivry_id)->whereIn('id', $this->selectedRecords)->get();
        foreach($data as $item){
            $item->update([
                'status' => 2,
            ]);
        }
        $this->reset('selectedRecords');
        session()->flash('message', 'Selected records have been deleted.');
    }
    public function DisAprovelSelected()
    {
        $data = DeliveryRecordBeneficial::where('delivery_record_id',$this->delivry_id)->whereIn('id', $this->selectedRecords)->get();
        foreach($data as $item){
            $item->update([
                'status' => 1,
            ]);
        }
        $this->reset('selectedRecords');
        session()->flash('message', 'Selected records have been deleted.');
    }

    public function render()
    {
        
        $query = DeliveryRecordBeneficial::where('delivery_record_id',$this->delivry_id)->with(['beneficial','beneficial.actor', 'product'])
            ->whereHas('beneficial', function ($query) {
                $query->where('full_name', 'like', '%'.$this->searchFullName.'%');
            })->when($this->searchIdNum, function ($query) {
                $query->whereHas('beneficial', function ($q) {
                    $q->where('id_num', '=', $this->searchIdNum);
                });
            })->when($this->searchWifeName, function ($query) {
                $query->whereHas('beneficial', function ($q) {
                    $q->where('wife_name',  'like', '%'.$this->searchWifeName.'%');
                });
            })->when($this->searchWifeIdNum, function ($query) {
                $query->whereHas('beneficial', function ($q) {
                    $q->where('wife_id_num',  'like', '%'.$this->searchWifeIdNum.'%');
                });
            })->when($this->searchMobile, function ($query) {
                $query->whereHas('beneficial', function ($q) {
                    $q->where('mobile',  'like', '%'.$this->searchMobile.'%');
                });
            })->when($this->searchActorName, function ($query) {
                $query->whereHas('beneficial.actor', function ($q) {
                    $q->where('name',  'like', '%'.$this->searchActorName.'%');
                });
            });

        if ($this->showAll) {
            $deliveryRecords = $query->get(); // Show all records
        } else {
            $deliveryRecords = $query->paginate(10);
        }

        return view('livewire.delivery-records-table', [
            'deliveryRecords' => $deliveryRecords,
        ]);
    }
}
