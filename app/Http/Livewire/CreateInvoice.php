<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Category;
use App\Models\Actor;
use App\Models\WordFood;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice; // Assuming you have an Invoice model
use App\Models\InvoiceItem; // Assuming you have an InvoiceItem model
use Carbon\Carbon;

class CreateInvoice extends Component
{
    public $products;
    public $providers;
    public $categories;
    public $units;
    public $actors;
    public $beneficiaries; 
    

    public $provider_id;
    public $category_id;
    public $port_name;
    public $type;
    public $receiver_type;
    public $receiver_id;
    public $og_name;

    public $invoiceItems = []; // Array to hold multiple items

    protected $rules = [
        'invoiceItems.*.product_id' => 'required',
        'invoiceItems.*.category_id' => 'required',
        'invoiceItems.*.quantity' => 'required|numeric|min:1',
        'invoiceItems.*.unit_id' => 'required',
        'provider_id' => 'required_if:type,in',
        'category_id' => 'required_if:type,in',
        'port_name' => 'required_if:type,in', 
        'type' => 'required',
    ];

    protected function messages()
    {
        return [
            'invoiceItems.*.product_id.required' => 'Please select a product for each item.',
            'invoiceItems.*.category_id.required' => 'Category is required for each item.',
            'invoiceItems.*.quantity.required' => 'Quantity is required for each item.',
            'invoiceItems.*.quantity.numeric' => 'Quantity must be a number.',
            'invoiceItems.*.quantity.min' => 'Quantity must be at least 1.',
            'invoiceItems.*.unit_id.required' => 'Please select a unit for each item.',
            'provider_id.required' => 'Please select a provider.',
            'category_id.required' => 'Please select a main category.',
            'port_name.required' => 'The port name is required.',
            'type.required' => 'The type is required.',
        ];
    }


    public function mount()
    {
        $this->products = Product::all();
        $this->providers = Provider::all();
        $this->categories = Category::all();
        $this->units = Unit::all();
        $this->actors = Actor::all();
        $this->beneficiaries = WordFood::all();
        // Add an initial empty item
        $this->invoiceItems[] = [
            'product_id' => '', 
            'category_id' => '', 
            'quantity' => 1, 
            'unit_id' => ''
        ];
    }

    // Add a new product row
    public function addItem()
    {
        $this->invoiceItems[] = [
            'product_id' => '', 
            'category_id' => '', 
            'quantity' => 1, 
            'unit_id' => ''
        ];
    }

    // Remove a product row
    public function removeItem($index)
    {
        unset($this->invoiceItems[$index]);
        $this->invoiceItems = array_values($this->invoiceItems); // Reset array indexes
    }

    public function submit()
    {
        $this->validate();

        // Check if the requested quantities are available for each product
        foreach ($this->invoiceItems as $item) {
            $product = Product::find($item['product_id']);
            
            if ($this->type == 'out' && $product->quantity < $item['quantity']) {
                session()->flash('message', 'Error: The requested quantity for ' . $product->name . ' exceeds available stock.');
                return; // Stop the execution if there's an error
            }
        }

        DB::transaction(function () {
            // Create the invoice
            $invoice = Invoice::create([
                'provider_id' => $this->type == 'out' ? 6 : $this->provider_id,
                'port_name' => $this->port_name,
                'category_id' => $this->type == 'out' ? 1 : $this->category_id,
                'type' => $this->type ?? 'in',
                'date' => Carbon::now(),
                'og_name' => $this->og_name ?? '',
                'receiver_type' => $this->receiver_type ?? 0,
                'receiver_id' => $this->receiver_id ?? 0,
               
            ]);

            // Create invoice items
            foreach ($this->invoiceItems as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'category_id' => $item['category_id'],
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_id' => $item['unit_id'],
                ]);

                if($this->type == 'in') {

                    $product = Product::find($item['product_id']);
                    $product->update([
                         'quantity' => $product->quantity + $item['quantity']
                    ]);
                }

                if($this->type == 'out') {

                    $product = Product::find($item['product_id']);
                    if($product->quantity < $item['quantity']){
                        session()->flash('message', 'Error.');
                    }else{
                        $product->update([
                            'quantity' => $product->quantity - $item['quantity']
                       ]);
                    }
                   
                }

                if($this->type == 'damaged') {

                    $product = Product::find($item['product_id']);
                    if($product->quantity < $item['quantity']){
                        session()->flash('message', 'Error.');
                    }else{
                        $product->update([
                            'quantity' => $product->quantity - $item['quantity']
                       ]);
                    }
                   
                }


            }
        });

        session()->flash('message', 'Invoice created successfully.');

        // Optionally, reset the form
        //$this->resetForm();
    }

    public function render()
    {
        return view('livewire.create-invoice');
    }
}
