<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Actor;
use App\Models\InvoiceItem;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InvoicesExport;

class InvoiceTable extends Component
{
    use WithPagination;

    public $exportFormat;
    public $searchProvider = null;
    public $searchProduct = null;
    public $searchDate = null; // For filtering by date
    public $searchPort = null; // For filtering by port name
    public $searchActor = null; // For filtering by actor name
    public $searchOgName = null; // For filtering by og_name 
    public $searchType = null; // For filtering by og_name 
    public $perPage = 15;  // Default value
    public $showAll = false;  // Toggle state for "Show All"
    public $selectedInvoices = [];  // Array to hold selected invoice IDs
    public $selectAll = false;
    public $invoiceDetails;  // Holds the selected invoice details for the modal

    public function showAll()
    {
        $this->perPage = null;  // This will show all items
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

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedInvoices = Invoice::pluck('id')->toArray();  // Select all invoices
        } else {
            $this->selectedInvoices = [];  // Deselect all
        }
    }

    public function render()
    {
        $query = Invoice::with('provider', 'items', 'actor')
            ->when($this->searchProvider, function ($query) {
                $query->where('provider_id', $this->searchProvider);
            })
            ->when($this->searchProduct, function ($query) {
                $query->whereHas('items', function ($q) {
                    $q->where('product_id', $this->searchProduct);
                });
            })
            ->when($this->searchDate, function ($query) {
                $query->whereDate('created_at', $this->searchDate);
            })
            ->when($this->searchPort, function ($query) {
                $query->where('port_name', $this->searchPort);
            })
            ->when($this->searchActor, function ($query) {
                $query->whereHas('actor', function ($q) {
                    $q->where('name', 'like', '%'.$this->searchActor.'%');
                });
            })
            ->when($this->searchOgName, function ($query) {
                $query->where('og_name', 'like', '%'.$this->searchOgName.'%');
            })
            ->when($this->searchType, function ($query) {
                $query->where('type', $this->searchType);
            });
    
      
            $invoices = $query->paginate($this->perPage); // Use pagination when showAll is false

    
        $providers = Provider::all();
        $products = Product::all();
        $actors = Actor::all();
    
        return view('livewire.invoice-table', [
            'invoices' => $invoices,
            'providers' => $providers,
            'products' => $products,
            'actors' => $actors,
            'selectedInvoices' => $this->selectedInvoices,
            'selectAll' => $this->selectAll,
        ]);
    }
    
 

    public function exportSelected()
    {
       
        if (empty($this->selectedInvoices)) {
            return session()->flash('error', 'No records selected.');
        }
    
        // Fetch the data for the selected records, including related models
        $data = Invoice::with('provider', 'items', 'actor')->whereIn('id',$this->selectedInvoices)->get();
        
        // Generate PDF using SnappyPDF
            $pdf = SnappyPdf::loadView('invoices_pdf', [
                'invoices' => $data,
            ])
            ->setPaper('a4')
            ->setOption('margin-top', 10)
            ->setOption('margin-left', 10)
            ->setOption('margin-right', 10)
            ->setOption('margin-bottom', 10);

        // Return the generated PDF for download
        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->output();
        }, 'invoices.pdf');
    }

    public function exportSelectedExcel()
    {
       
        if (empty($this->selectedInvoices)) {
            return session()->flash('error', 'No records selected.');
        }
    
        // Fetch the data for the selected records, including related models
        $data = Invoice::with('provider', 'items', 'actor')->whereIn('id',$this->selectedInvoices)
                 ->get();
    
        // Generate PDF using SnappyPDF
            
            return Excel::download(new InvoicesExport($data), 'invoice-all.xlsx');
        // Return the generated PDF for download
        // return response()->streamDownload(function() use ($pdf) {
        //     echo $pdf->output();
        // }, 'delivery-record.pdf');
    }


    // Load invoice details and trigger the modal
    public function viewInvoice($invoiceId)
    {
        $this->invoiceDetails = Invoice::with('provider', 'items', 'actor')->findOrFail($invoiceId);

        $this->dispatchBrowserEvent('show-invoice-modal');  // Trigger JS event to show the modal
    }

    public function closeInvoiceModal()
    {
        $this->dispatchBrowserEvent('hide-invoice-modal');
    }


    public function InvoicePdf($invoiceId)
    {
      
    
        // Fetch the data for the selected records, including related models
         $data = Invoice::with('provider', 'items', 'actor')->where('id',$invoiceId)->first();
        
        // Generate PDF using SnappyPDF
            $pdf = SnappyPdf::loadView('invoice_pdf', [
                'invoice' => $data,
            ])
            ->setPaper('a4')
            ->setOption('margin-top', 10)
            ->setOption('margin-left', 10)
            ->setOption('margin-right', 10)
            ->setOption('margin-bottom', 10);

        // Return the generated PDF for download
        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->output();
        }, 'invoices.pdf');
    }
}
